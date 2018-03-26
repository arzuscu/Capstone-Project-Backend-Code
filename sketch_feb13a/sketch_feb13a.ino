
#include <SPI.h>
#include <Ethernet.h>
#include <DHT.h>
#define DHTPIN 7    
#define DHTTYPE DHT22   // DHT 22  (AM2302), AM2321
DHT dht(DHTPIN, DHTTYPE);
byte mac[] = { 0xDE, 0xAD, 0xBE, 0xEF, 0xFE, 0xED };
char server[] = "www.google.com";    // name address for Google (using DNS)
IPAddress ip(192, 168, 0, 177);
EthernetClient client;

void setup() {
  Serial.begin(9600);
  dht.begin();
  while (!Serial) {
    ; // wait for serial port to connect. Needed for native USB port only
  }
  // start the Ethernet connection:
  if (Ethernet.begin(mac) == 0) {
    Serial.println("Failed to configure Ethernet using DHCP");
    // try to congifure using IP address instead of DHCP:
    Ethernet.begin(mac, ip);
  }
  // give the Ethernet shield a second to initialize:
  delay(1000);
  Serial.println("connecting...");

  // if you get a connection, report back via serial:
}

void loop() {
   // delay(1800000);
   //delay(6000);

  //int minute = 1000;
 // int d=60000; 

  float h = dht.readHumidity();
  float t = dht.readTemperature(); 

  for ( int x = 0 ; x < 29 ; x++){
    Serial.print("testing ... ");
    Serial.print(x);
    Serial.print(" ~ ");
    Serial.print(h);
    Serial.print(" ~ ");
    Serial.println(t);
    delay(60000);
  }
    Serial.println("Sending");
    Serial.println(h);
    Serial.println(t);
    apiPost(String(h), String(t));
    delay(60000);
  

}
void apiPost(String humadity, String temprature ){
      if (client.connect(server, 80)) {
    Serial.println("connected");
    // Make a HTTP request:
    client.println("GET /api.php?t=" + temprature +  "&h=" +humadity +  " HTTP/1.1");
    client.println("Host: 34.227.118.133");
    client.println("Connection: close");
    client.println();
    while (client.connected()) {
      while (client.available()) {
        char c = client.read();
      }
    }
    client.stop();
  } else {
    // if you didn't get a connection to the server:
    Serial.println("connection failed");
  }
}
