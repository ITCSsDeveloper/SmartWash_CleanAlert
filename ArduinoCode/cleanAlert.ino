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

void setup() 
{
  //Serial.begin(250000);
  Serial.begin(38400);
  
  pinMode(waterA, INPUT);  
  pinMode(waterB, INPUT);  

  pinMode(processA, INPUT);  
  pinMode(processB, INPUT); 

  pinMode(Digi1, OUTPUT);  
  pinMode(Digi2, OUTPUT);  
  pinMode(Digi3, OUTPUT);  
  pinMode(Digi4, OUTPUT);

  pinMode(InputA, OUTPUT);  
  pinMode(InputB, OUTPUT);  
  pinMode(InputC, OUTPUT);  
  pinMode(InputD, OUTPUT);  

  pinMode(WaterS, OUTPUT);  
  pinMode(WaterM, OUTPUT);  
  pinMode(WaterL, OUTPUT);  
  pinMode(WaterXL, OUTPUT);


  pinMode(Process1, OUTPUT);
  pinMode(Process2, OUTPUT);
  pinMode(Process3, OUTPUT);
  pinMode(Process4, OUTPUT);

  pinMode(PowerLED, OUTPUT); 

  Reset7seg(false); // Set To LOW
  ResetIC_74LS47(); // RESET ALL

        while (!Serial);           // Do nothing if no serial port is opened (added for Arduinos based on ATMEGA32U4)
        SPI.begin();               // Init SPI bus
        mfrc522.PCD_Init();        // Init MFRC522 card

        for (byte i = 0; i < 6; i++) 
        {
          key.keyByte[i] = 0xFF;
        }
      }

void ResetIC_74LS47()
{
	 digitalWrite(InputA, LOW);
	 digitalWrite(InputB, LOW);
	 digitalWrite(InputC, LOW);
	 digitalWrite(InputD, LOW);
}

void Reset7seg(bool enable)
{
	if(enable)
	{
		digitalWrite(Digi1, HIGH);
		digitalWrite(Digi2, HIGH);  
		digitalWrite(Digi3, HIGH);
		digitalWrite(Digi4, HIGH);
	}
	else
	{
		digitalWrite(Digi1, LOW);
		digitalWrite(Digi2, LOW);  
		digitalWrite(Digi3, LOW);
		digitalWrite(Digi4, LOW);
	}
}


void shownum(int number){
  switch(number)
  {
    case 0:
    digitalWrite(InputA, LOW);
    digitalWrite(InputB, LOW);
    digitalWrite(InputC, LOW);
    digitalWrite(InputD, LOW);
    break;

    case 1:
    digitalWrite(InputA, HIGH);
    digitalWrite(InputB, LOW);
    digitalWrite(InputC, LOW);
    digitalWrite(InputD, LOW);
    break;

    case 2:
    digitalWrite(InputA, LOW);
    digitalWrite(InputB, HIGH);
    digitalWrite(InputC, LOW);
    digitalWrite(InputD, LOW);
    break;

    case 3:
    digitalWrite(InputA, HIGH);
    digitalWrite(InputB, HIGH);
    digitalWrite(InputC, LOW);
    digitalWrite(InputD, LOW);
    break;

    case 4:
    digitalWrite(InputA, LOW);
    digitalWrite(InputB, LOW);
    digitalWrite(InputC, HIGH);
    digitalWrite(InputD, LOW);
    break;

    case 5:
    digitalWrite(InputA, HIGH);
    digitalWrite(InputB, LOW);
    digitalWrite(InputC, HIGH);
    digitalWrite(InputD, LOW);
    break;

    case 6:
    digitalWrite(InputA, LOW);
    digitalWrite(InputB, HIGH);
    digitalWrite(InputC, HIGH);
    digitalWrite(InputD, LOW);
    break;

    case 7:
    digitalWrite(InputA, HIGH);
    digitalWrite(InputB, HIGH);
    digitalWrite(InputC, HIGH);
    digitalWrite(InputD, LOW);
    break;

    case 8:

    digitalWrite(InputA, LOW);
    digitalWrite(InputB, LOW);
    digitalWrite(InputC, LOW);
    digitalWrite(InputD, HIGH);
    break;

    case 9:
    digitalWrite(InputA, HIGH);
    digitalWrite(InputB, LOW);
    digitalWrite(InputC, LOW);
    digitalWrite(InputD, HIGH);
    break;

    default:
    break;
  }
}

void seven_segment_show()
{  
  
  digitalWrite(Digi1, HIGH);
  shownum(h1);
  delay(time_refresh);
  digitalWrite(Digi1, LOW);
  
  digitalWrite(Digi2, HIGH);
  shownum(h2);
  delay(time_refresh);
  digitalWrite(Digi2, LOW);
  
  digitalWrite(Digi3, HIGH);
  shownum(m1);
  delay(time_refresh);
  digitalWrite(Digi3, LOW);
  
  digitalWrite(Digi4, HIGH);
  shownum(m2);
  delay(time_refresh);
  digitalWrite(Digi4, LOW);
}

void power_check()
{
   power_str = "0";
   if(analogRead(analog_power) > 350)
   {
      power_str = "1";
   }
}

void water_check()
{
    water_str = "0";
   // Water Status
    if(digitalRead(waterA) == HIGH && digitalRead(waterB) == HIGH) // 1 1
    {
      water_str = "4"; // XL
    }
    else if(digitalRead(waterA) == HIGH && digitalRead(waterB) == LOW) // 1 0
    {
       water_str = "3"; // L
    }
    else if(digitalRead(waterA) == LOW && digitalRead(waterB) == HIGH) // 0 1
    {
       water_str = "2"; // M
    }
    else if(digitalRead(waterA) == LOW && digitalRead(waterB) == LOW) // 0 0
    {
       water_str = "1"; // S
    }
  }

void process_check()
{
    process_str = "0";
    // Process Status
    if(digitalRead(processA) == HIGH && digitalRead(processB) == HIGH) // 1 1
    {
       process_str = "4"; // ปั่นหมาด
    }
    else if(digitalRead(processA) == HIGH && digitalRead(processB) == LOW) // 1 0
    {
      process_str = "3"; // ล้าง
    }
    else if(digitalRead(processA) == LOW && digitalRead(processB) == HIGH) // 0 1
    {
      process_str = "2"; // ซัก
    }
    else if(digitalRead(processA) == LOW && digitalRead(processB) == LOW) // 0 0
    {
      process_str = "1"; // แช่
    }
}

int ReadVR()
{
	return analogRead(analog_VR);
}

void printSerial()
{	
	str = "";
	str.concat(power_str);   //1
	str.concat(water_str); //2
	str.concat(process_str); //3
	str.concat(h1); //4
	str.concat(h2); //5 
	str.concat(m1); //6
	str.concat(m2); //7
	str.concat(complete); //8
	str.concat(_null); //9
	str.concat(_null); //10
	str.concat(_null); //11
	str.concat(_null); //12
	str.concat(_null); //13
	str.concat(_null); //14
	str.concat(_null); //15
	str.concat(_null); //16
	Serial.print(str); // MAX 16 byte
	delay(16);
}

void simulator()
{
	byte var = map(ReadVR(), 0, 1023, 0, 20);
	if(var == 0)
	{
		h1 =0; h2=0; m1=0; m2=0;
		complete = 0;
		Reset7seg(false);
		ResetIC_74LS47();
		digitalWrite(PowerLED,LOW);
		digitalWrite(Process1,LOW);
		digitalWrite(Process2,LOW);
		digitalWrite(Process3,LOW);
		digitalWrite(Process4,LOW);
	}
	else if (var == 1)
	{
		complete = 1;
		digitalWrite(PowerLED,HIGH);
		Reset7seg(true);
	}
	else if (var == 2)
	{
		digitalWrite(WaterS,HIGH);delay(100);
		digitalWrite(WaterS,LOW);

		digitalWrite(WaterM,HIGH);delay(100);
		digitalWrite(WaterM,LOW);

		digitalWrite(WaterL,HIGH);delay(100);
		digitalWrite(WaterL,LOW);

		digitalWrite(WaterXL,HIGH);delay(100);
		digitalWrite(WaterXL,LOW);
	}
	else if (var == 3)
	{
		digitalWrite(WaterL,HIGH);
	}
	else if (var == 4) // แช่ผ้า และ รอน้ำเต็ม
	{
		digitalWrite(Process1,HIGH);
		h2 = 1; // 0-9
		m1 = 3; // 0-5
		m2 = 0; // 0-9
		seven_segment_show();
	}
	else if (var == 5) // เมื่อน้ำเต็มแล้ว
	{
		digitalWrite(Process1,LOW);
		h2 = 1; // 0-9
		m1 = 1; // 0-5
		m2 = 5; // 0-9
		seven_segment_show();
	}
	else if (var == 6) // เมื่อน้ำเต็มแล้ว
	{
		digitalWrite(Process2,HIGH);
		seven_segment_show();
	}
	else if (var == 7) // เมื่อน้ำเต็มแล้ว
	{
		digitalWrite(Process2,HIGH);
		h2 = 1; // 0-9
		m1 = 0; // 0-5
		m2 = 0; // 0-9
		seven_segment_show();
	}
	else if (var == 8) // เมื่อน้ำเต็มแล้ว
	{
		digitalWrite(Process2,LOW);
		h2 = 0; // 0-9
		m1 = 4; // 0-5
		m2 = 5; // 0-9
		seven_segment_show();
	}
	else if (var == 9) // เมื่อน้ำเต็มแล้ว
	{
		digitalWrite(Process3,HIGH);
		seven_segment_show();
	}
	else if (var == 10) // เมื่อน้ำเต็มแล้ว
	{
		digitalWrite(Process3,LOW);
		m1 = 1; // 0-5
		m2 = 5; // 0-9
		seven_segment_show();
	}
	else if (var == 11) // เมื่อน้ำเต็มแล้ว
	{
		digitalWrite(Process4,HIGH);
		m1 = 1; // 0-5
		m2 = 5; // 0-9
		seven_segment_show();
	}
	else if (var == 11) // เมื่อน้ำเต็มแล้ว
	{
		m1 = 1; // 0-5
		m2 = 0; // 0-9
		seven_segment_show();
	}
	else if (var == 12) // เมื่อน้ำเต็มแล้ว
	{
		m1 = 0; // 0-5
		m2 = 5; // 0-9
		seven_segment_show();
	}
	else if (var == 12) // เมื่อน้ำเต็มแล้ว
	{
		m2 = 3; // 0-9
		seven_segment_show();
	}
	else if (var == 13) // เมื่อน้ำเต็มแล้ว
	{
		m2 = 2; // 0-9
		seven_segment_show();
	}
	else if (var == 14) // เมื่อน้ำเต็มแล้ว
	{
		m2 = 1; // 0-9
		seven_segment_show();
	}
	else if (var == 15) // เมื่อน้ำเต็มแล้ว
	{
		m2 = 0; // 0-9
		seven_segment_show();
	}
	else if (var == 16) // เมื่อน้ำเต็มแล้ว
	{
		digitalWrite(WaterL,LOW);
		digitalWrite(Process4,LOW);
		seven_segment_show();
		complete = 2;
	}
	else if (var == 17)
	{
		Reset7seg(false);
		ResetIC_74LS47();
		digitalWrite(PowerLED,LOW);
		digitalWrite(Process1,LOW);
		digitalWrite(Process2,LOW);
		digitalWrite(Process3,LOW);
		digitalWrite(Process4,LOW);
		complete = 2;
	}
}

void RFID_read()
{
	 if ( ! mfrc522.PICC_IsNewCardPresent() || ! mfrc522.PICC_ReadCardSerial() ) {
            delay(50);
            return;
        }
        for (byte i = 0; i < mfrc522.uid.size; i++) {
                Serial.print(mfrc522.uid.uidByte[i] < 0x10 ? " 0" : " ");
                Serial.print(mfrc522.uid.uidByte[i], HEX);
        } 
}


/*
 ----------------------------------------------------------------------------- Nicola Coppola
 * Typical pin layout used:
 * -----------------------------------------------------------------------------------------
 *             MFRC522      Arduino       Arduino   Arduino    Arduino          Arduino
 *             Reader/PCD   Uno           Mega      Nano v3    Leonardo/Micro   Pro Micro
 * Signal      Pin          Pin           Pin       Pin        Pin              Pin
 * -----------------------------------------------------------------------------------------
 * RST/Reset   RST          9             5         D9         RESET/ICSP-5     RST
 * SPI SS      SDA(SS)      10            53        D10        10               10
 * SPI MOSI    MOSI         11 / ICSP-4   51        D11        ICSP-4           16
 * SPI MISO    MISO         12 / ICSP-1   50        D12        ICSP-1           14
 * SPI SCK     SCK          13 / ICSP-3   52        D13        ICSP-3           15
 *
 * The reader can be found on eBay for around 5 dollars. Search for "mf-rc522" on ebay.com. 
 */

void loop()
{	
	power_check();
	water_check();
	process_check();
	printSerial();
	// simulator();
	//RFID_read();
}



