#include <SPI.h>
// #include <MFRC522.h>
#define NEW_UID {0xDE, 0xAD, 0xBE, 0xEF}
#define SS_PIN 53
#define RST_PIN 49

MFRC522 mfrc522(SS_PIN, RST_PIN);        // Create MFRC522 instance.
MFRC522::MIFARE_Key key;

byte waterA = 2;
byte waterB = 3;

byte processA = 4;
byte processB = 5;

byte Digi1 = 6;
byte Digi2 = 7;
byte Digi3 = 8;
byte Digi4 = 9;

byte InputA = 10;
byte InputB = 11;
byte InputC = 12;
byte InputD = 13;

byte WaterS = 14;
byte WaterM = 15;
byte WaterL = 16;
byte WaterXL = 17;

byte Process1 = 18;
byte Process2 = 19;
byte Process3 = 20;
byte Process4 = 21;

byte PowerLED = 22;

byte analog_power = 0;
byte analog_VR = 1;

byte time_refresh = 1; // refresh 7segment val*4 = real delay
byte h1 = 0; // 0-9
byte h2 = 0; // 0-9
byte m1 = 0; // 0-5
byte m2 = 0; // 0-9
byte milisec = 0;

String str = ""; // สำหรับต่อข้อความก่อนส่ง Serial
String process_str = "0";
String water_str = "0";
String _null = ".";
String power_str = "0";

byte complete = 0; //0 ไม่ทำงาน - 1 กำลังทำงาน - 2 ทำสำเร็จ