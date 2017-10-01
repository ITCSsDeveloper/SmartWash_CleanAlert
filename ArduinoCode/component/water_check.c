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