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