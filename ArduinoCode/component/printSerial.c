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