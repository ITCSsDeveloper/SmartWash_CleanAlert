
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