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