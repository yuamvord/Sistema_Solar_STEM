/**
 * @file ArduinoSistemaSolarSTEM.ino
 * @brief Codigo principal del arduino
 * @author
 * Dream Team Systems
 * @date Octubre 2025
 */
#include <WiFiS3.h>
#include <Adafruit_NeoPixel.h>
#include <ArduinoJson.h>

/** @brief se define la configuración del internet del Arduino*/
const char* ssid = "CLARO_C98434";
const char* pass = "4FCE27D53E";
WiFiServer server(80);
/** @brief se define la base de datos a la cual se conectara el Arduino para consultar los estados */
const char* FIREBASE_HOST = "dreamteamsolarstem-default-rtdb.firebaseio.com";
const char* FIREBASE_AUTH = "";

int syncIndex = 0;
unsigned long lastSync = 0;

WiFiSSLClient client;

/** @brief Se define la configuración de los pines */
#define LED_PIN 6
#define NUM_LEDS 30
#define STEP_PIN 3
#define DIR_PIN 4

Adafruit_NeoPixel strip(NUM_LEDS, LED_PIN, NEO_GRB + NEO_KHZ800);

/** @brief Se definen las variables globales
 * @details Se manejaran las leds, el brillo y el motor
 */
int ledMode = 0;
bool ledsOn = false;
int brillo = 128;

bool prevLedsOn = false;
int prevLedMode = -1;
int prevBrillo = -1;

enum MotorDirection { STOP = 0, RIGHT, LEFT };
bool motorOn = false;
MotorDirection motorDir = STOP;
int stepSpeed = 6000;
unsigned long lastStepTime = 0;

const char* ledNames[] = { "Rojo fijo", "Verde parpadeante", "Arcoiris" };

/** @brief Se realiza la conexión a wifi y se imprime la IP que se genera */
void connectWiFi() {
  Serial.println("Intentando conectar a WiFi...");
  while (WiFi.status() != WL_CONNECTED) {
    WiFi.config(INADDR_NONE, INADDR_NONE, INADDR_NONE, INADDR_NONE);
    WiFi.begin(ssid, pass);
    Serial.print(".");
    delay(5000);
  }
  Serial.print("✅ Conectado a WiFi. IP: ");
  Serial.println(WiFi.localIP());
}

/** @brief Se agregan las funciones que necesita firebase para poder conectarse con el Arduino */
String firebaseGet(const char* path) {
  String url = String("/") + path + ".json";
  if (FIREBASE_AUTH[0] != '\0') url += "?auth=" + String(FIREBASE_AUTH);

  if (!client.connect(FIREBASE_HOST, 443)) {
    Serial.println("⚠️ No se pudo conectar a Firebase");
    return "";
  }

  client.println("GET " + url + " HTTP/1.1");
  client.println("Host: " + String(FIREBASE_HOST));
  client.println("Connection: close");
  client.println();

  String response = "";
  unsigned long start = millis();

  while (millis() - start < 5000) {
    while (client.available()) response += (char)client.read();
    if (!client.connected()) break;
  }
  client.stop();

  int jsonIndex = response.indexOf("\r\n\r\n");
  if (jsonIndex >= 0) response = response.substring(jsonIndex + 4);

  response.trim();
  response.replace("\"", "");
  return response;
}

void firebasePut(const char* path, const String& value) {
  String url = String("/") + path + ".json";
  if (FIREBASE_AUTH[0] != '\0') url += "?auth=" + String(FIREBASE_AUTH);

  if (!client.connect(FIREBASE_HOST, 443)) {
    Serial.println("⚠️ No se pudo conectar a Firebase");
    return;
  }

  String body = value;
  client.println("PUT " + url + " HTTP/1.1");
  client.println("Host: " + String(FIREBASE_HOST));
  client.println("Content-Type: application/json");
  client.print("Content-Length: ");
  client.println(body.length());
  client.println("Connection: close");
  client.println();
  client.println(body);

  while (client.connected()) client.read(); 
  client.stop();
}

/** @brief La función setup que ejecutara el codigo principal que se estara utilizando */
void setup() {
  Serial.begin(115200);
  strip.begin();
  strip.setBrightness(brillo);
  strip.show();

  pinMode(STEP_PIN, OUTPUT);
  pinMode(DIR_PIN, OUTPUT);
  digitalWrite(STEP_PIN, LOW);
  digitalWrite(DIR_PIN, LOW);

  connectWiFi();
  server.begin();

  Serial.println("🌐 Servidor web iniciado");
}

/** @brief Define los movimientos que tendrá el motor */
void updateMotor() {
  if (!motorOn || motorDir == STOP) return;

  digitalWrite(DIR_PIN, motorDir == RIGHT ? HIGH : LOW);
  if (micros() - lastStepTime >= stepSpeed) {
    lastStepTime = micros();
    digitalWrite(STEP_PIN, HIGH);
    delayMicroseconds(2);
    digitalWrite(STEP_PIN, LOW);
  }
}

/** @brief Define los colores y modos a los cuales se podrá acceder desde el panel de control */
void handleLEDs() {
  if (!ledsOn) {
    for (int i = 0; i < NUM_LEDS; i++) strip.setPixelColor(i, 0);
    strip.show();
    return;
  }

  strip.setBrightness(brillo);

  switch (ledMode) {
    case 0: // Rojo fijo
      for (int i = 0; i < NUM_LEDS; i++)
        strip.setPixelColor(i, strip.Color(255, 0, 0));
      break;

    case 1: // Verde parpadeante
      if ((millis() / 500) % 2 == 0)
        for (int i = 0; i < NUM_LEDS; i++)
          strip.setPixelColor(i, strip.Color(0, 255, 0));
      else
        for (int i = 0; i < NUM_LEDS; i++)
          strip.setPixelColor(i, 0);
      break;

    case 2: // Arcoiris
      for (int i = 0; i < NUM_LEDS; i++) {
        int pixelHue = (i * 256 / NUM_LEDS + millis() / 10) & 255;
        strip.setPixelColor(i, strip.gamma32(strip.ColorHSV(pixelHue * 256)));
      }
      break;
  }
  strip.show();
}

/** @brief Sincroniza los movimientos del motor y las luces de la led con la base de datos en firebase */
void syncFromFirebase() {
  
  String ledVal = firebaseGet("control/led");
  ledsOn = (ledVal == "on");
  Serial.println("LEDs: " + String(ledsOn ? "ON" : "OFF"));

  
  String modeVal = firebaseGet("control/mode");
  ledVal.trim();
  ledsOn = (ledVal.equalsIgnoreCase("on"));

  if (modeVal.length()) {
    int mode = modeVal.toInt();
    if (mode >= 0 && mode <= 2) ledMode = mode;
    Serial.println("Modo LED: " + String(ledMode) + " (" + String(ledNames[ledMode]) + ")");
  }

  
  String brilloVal = firebaseGet("control/brillo");
  if (brilloVal.length()) {
    brillo = brilloVal.toInt();
    brillo = constrain(brillo, 0, 255);
    Serial.println("Brillo: " + String(brillo));
  }

  
  String motorVal = firebaseGet("control/motor");
  motorVal.trim();

  if (motorVal == "on") {
    motorOn = true;
    motorDir = STOP;
  } else if (motorVal == "off") {
    motorOn = false;
    motorDir = STOP;
  } else if (motorVal == "right") {
    motorOn = true;
    motorDir = RIGHT;
  } else if (motorVal == "left") {
    motorOn = true;
    motorDir = LEFT;
  }
}

/** @brief Manejo de clientes web */
void handleClient() {
  WiFiClient client = server.available();
  if (!client) return;

  String request = client.readStringUntil('\r');
  client.flush();

  if (request.indexOf("GET /LEDMODE=") >= 0) {
    int modeIndex = request.substring(request.indexOf('=') + 1).toInt();
    if (modeIndex >= 0 && modeIndex <= 2) {
      ledMode = modeIndex;
      ledsOn = true;
      firebasePut("control/mode", String(modeIndex));
      firebasePut("control/led", "\"on\"");
    }
  }

  if (request.indexOf("GET /LED=ON") >= 0) {
    ledsOn = true;
    firebasePut("control/led", "\"on\"");
  }

  if (request.indexOf("GET /LED=OFF") >= 0) {
    ledsOn = false;
    firebasePut("control/led", "\"off\"");
  }

  if (request.indexOf("GET /BRILLOUP") >= 0) {
    brillo = min(brillo + 25, 255);
    firebasePut("control/brillo", String(brillo));
  }

  if (request.indexOf("GET /BRILLODOWN") >= 0) {
    brillo = max(brillo - 25, 0);
    firebasePut("control/brillo", String(brillo));
  }

  if (request.indexOf("GET /MOTOR=ON") >= 0) {
    motorOn = true;
    motorDir = STOP;
    firebasePut("control/motor", "\"on\"");
  }

  if (request.indexOf("GET /MOTOR=OFF") >= 0) {
    motorOn = false;
    motorDir = STOP;
    firebasePut("control/motor", "\"off\"");
  }

  if (request.indexOf("GET /MOTOR=RIGHT") >= 0) {
    motorOn = true;
    motorDir = RIGHT;
    firebasePut("control/motor", "\"right\"");
  }

  if (request.indexOf("GET /MOTOR=LEFT") >= 0) {
    motorOn = true;
    motorDir = LEFT;
    firebasePut("control/motor", "\"left\"");
  }
/** @brief Panel de control del arduino */
  client.println("HTTP/1.1 200 OK");
  client.println("Content-Type: text/html");
  client.println();
  client.println("<html><head><title>Control LEDs y Motor</title></head><body>");
  client.println("<h1>Control de LEDs y Motor</h1>");

  client.println("<h2>Modos LED</h2>");
  for (int i = 0; i <= 2; i++)
    client.println("<button onclick=\"location.href='/LEDMODE=" + String(i) + "'\">" + String(ledNames[i]) + "</button><br>");

  client.println("<br><button onclick=\"location.href='/LED=ON'\">Encender LEDs</button>");
  client.println("<button onclick=\"location.href='/LED=OFF'\">Apagar LEDs</button>");

  client.println("<h2>Control de Brillo</h2>");
  client.println("<button onclick=\"location.href='/BRILLOUP'\">🔆 Subir Brillo</button>");
  client.println("<button onclick=\"location.href='/BRILLODOWN'\">🔅 Bajar Brillo</button>");
  client.println("<p>Nivel actual: " + String(brillo) + "</p>");

  client.println("<h2>Control Motor</h2>");
  client.println("<button onclick=\"location.href='/MOTOR=ON'\">Encender Motor</button>");
  client.println("<button onclick=\"location.href='/MOTOR=OFF'\">Apagar Motor</button><br><br>");
  client.println("<button onclick=\"location.href='/MOTOR=RIGHT'\">Girar Derecha</button>");
  client.println("<button onclick=\"location.href='/MOTOR=LEFT'\">Girar Izquierda</button>");
  client.println("</body></html>");

  delay(1);
  client.stop();
}


/** @brief Bucle principal optimizado */
void loop() {
  unsigned long now = millis();


  handleClient();  

  
  handleLEDs();   

  
  updateMotor();  


  static unsigned long lastFirebaseSync = 0;
  static int syncIndex = 0;

  if (now - lastFirebaseSync >= 10000) {
    lastFirebaseSync = now;

    switch (syncIndex) {
      case 0: { String ledVal = firebaseGet("control/led"); ledsOn = (ledVal == "on"); break; }
      case 1: { String modeVal = firebaseGet("control/mode"); if(modeVal.length()) ledMode = modeVal.toInt(); break; }
      case 2: { String brilloVal = firebaseGet("control/brillo"); if(brilloVal.length()) brillo = constrain(brilloVal.toInt(), 0, 255); break; }
      case 3: { 
        String motorVal = firebaseGet("control/motor"); 
        motorVal.trim();
        if (motorVal == "on") motorOn = true, motorDir = STOP;
        else if (motorVal == "off") motorOn = false, motorDir = STOP;
        else if (motorVal == "right") motorOn = true, motorDir = RIGHT;
        else if (motorVal == "left") motorOn = true, motorDir = LEFT;
        break; 
      }
    }

    syncIndex = (syncIndex + 1) % 4;
  }
}