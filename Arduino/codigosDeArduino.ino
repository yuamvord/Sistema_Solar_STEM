void setup() {
  pinMode(13, OUTPUT); // Envía salida al PIN 13


}

void loop() {
  digitalWrite(13, HIGH);  // Se le indica al pin que encienda
  delay(1000); // Indica el tiempo a esperar para encender y apagar
  digitalWrite(13, LOW); // Se le indica al pin que debe apagarse
  delay(1000);
}
