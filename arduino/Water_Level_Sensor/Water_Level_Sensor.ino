#define trigpin D0  
#define echopin D1

#include<ESP8266WiFi.h>
#include<WiFiClient.h>
#include <ESP8266HTTPClient.h>
#include<ESP8266WebServer.h>

const char* ssid = "";
const char* password = "";
const char* server = "167.172.95.219"; // 

String postData;
WiFiClient  client;

void setup()
{
  Serial.begin(9600);
  pinMode(trigpin, OUTPUT);
  pinMode(echopin, INPUT);
  WiFi.begin(ssid,password);

  Serial.print("Conecting");
  while(WiFi.status() !=WL_CONNECTED){
   Serial.print(".");
   delay(5000);
  }

  Serial.print("Connected to ");
  Serial.print(ssid);
  Serial.println("");
  Serial.print("IP Address is ");
  Serial.print(WiFi.localIP());
  Serial.println(" "); 
  
}

void loop()
{
 int duration, distance,reading;
 String level;
 int station = 111;
 digitalWrite(trigpin, HIGH);

  delayMicroseconds(1000);  
  digitalWrite(trigpin, LOW);
  
  duration = pulseIn(echopin,HIGH);
  
  distance = ( duration / 2) / 29.1;
  reading = -(distance-21);
  
  Serial.println("cm:"); 
  Serial.println(reading);
  
  if(  (reading >= 0) && (reading <= 3)   ) 
  {
  level = "NORMAL";
  Serial.println(level);
  }
  else if(  (reading > 3) && (reading <= 6)   ) 
  {
  level = "ALERT";
  Serial.println(level);
  }
  else if(  (reading > 6) && (reading <= 9)   ) 
  {
  level = "WARNING";
  Serial.println(level);
  }
  else if(  (reading > 9) && (reading <= 12)   ) 
  {
  level = "DANGER LOW";
  Serial.println(level);
  }
  else if(  (reading > 12) && (reading <= 15)   ) 
  {
  level = "DANGER MEDIUM";
  Serial.println(level);
  }
  else if(  (reading > 15) && (reading <= 21)   ) 
  {
  level = "DANGER HIGH";
  Serial.println(level);
  }

  String stato ="station="+(String)station;
  String reado ="&reading="+(String)reading;
  String levo ="&level="+(String)level;
  postData = stato+reado+levo;
  Serial.println(postData);
  
  if(client.connect(server,80))
  {
    client.println("POST /FYP/sensor/sensorpost.php HTTP/1.1"); //page php yg akan terima data
    client.println("Host: 192.168.1.107"); // nama server
    client.println("Content-Type: application/x-www-form-urlencoded");
    client.print("Content-Length: ");
    client.println(postData.length());
    client.println();
    client.println(postData); 
    Serial.println("Connected");
    delay(5000); //5seconds
  }
  else
    Serial.println("Failed to Connect");

  delay(1000);


}
