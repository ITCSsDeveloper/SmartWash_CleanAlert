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