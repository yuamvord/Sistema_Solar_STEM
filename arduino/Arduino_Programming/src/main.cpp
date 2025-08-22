#include <Arduino.h>
#include <AccelStepper.h> // libreria para el motor Nema 17
#include <WiFi.h> // libreria para conexión por wifi, probar WiFiNINA.h si falla


// Configuración inicial
const char* WIFI_SSID = "TIGO-F6FB";
const char* WIFI_PSS = "4D9697511599";

const int LED_PINS[] = {2, 3, 4, 5, 6, 7, 8, 9, 10};
const uint8_t NUM_LEDS = sizeof(LED_PINS)/sizeof(LED_PINS[0]);

const int STEP_PIN = 10;
const int DIR_PIN = 11;
const int ENABLE_PIN = 12;


// Levanta un server en el puerto 80
WiFiServer server(80);

// Ayuda en el movimiento del motor

AccelStepper stepper(AccelStepper::DRIVER, STEP_PIN, DIR_PIN, ENABLE_PIN);

bool rotating = false;

void setup(){
  Serial.begin(115200);

  for(uint8_t i=0; i<NUM_LEDS; i++){
    pinMode(LED_PINS[i], OUTPUT);
    digitalWrite(LED_PINS[i], LOW);
  }
}



// put function declarations here:
int myFunction(int, int);

void setup() {
  // put your setup code here, to run once:
  int result = myFunction(2, 3);
}

void loop() {
  // put your main code here, to run repeatedly:
}

// put function definitions here:
int myFunction(int x, int y) {
  return x + y;
}
