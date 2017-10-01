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
