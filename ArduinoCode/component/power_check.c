void power_check()
{
   power_str = "0";
   if(analogRead(analog_power) > 350)
   {
      power_str = "1";
   }
}