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