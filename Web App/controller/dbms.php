<?php
@session_start();
$dbms = true;
ini_set('max_execution_time', 300); //300 seconds = 5 minutes
include("protection.php");

// dmbs class
// Cr ITCS's Developer 2015
// Ratchanon Chompoobut ICT VIP SC KKU 
// https://www.facebook.com/GmtanBeartai2010

// Version 1.3.2

/*
 How to use step 1
 1. include (dbms.php); // include dbms file
 2. $obj = new dbms();  // New Object form dbms

 -- Option in Class --
 1.dbms_Insert(sql_command) return bool
 2.dbms_Delete(sql_command) return bool
 3.dbms_Select(sql_command) return Object Array[record]
 4.dbms_Update(sql_command) return bool

 Example SELECT  ----- (Return Array)
  $obj = new dbms();
  $sql_com = "SELECT * FROM `tb_form1` ORDER BY `form_date` DESC Limit 20";
  $result = $obj->dbms_Select($sql_com);
  echo "$result[$i]->name_id";

 Example INSERT , UPDATE , DELETE  ----- (Return bool)
  $obj = new dbms();
  $sql_com = "INSERT INTO `sn`.`tb_employee` (`emp_id`, `emp_name`, `emp_user`, `emp_pass`) VALUES (NULL, 'MOOBA', 'user', 'password');";

  if($obj->dbms_Insert($sql_com)) {
    echo "Insert Complete";
  }
 else{
      echo "Insert Error";
  }

  New Future 1.2
    $obj->dbms_header( "path string url" );

  New Future in 1.3.1
   -- Function dbms_insert_log
   -- For record all command

   New Future in 1.3.2 (20:38 7/2/2559)
    -- Function dbms_subString
*/


   class dbms
   {
   	private $host = "localhost";
   	private $data = "itcssme_project";
   	private $user = "itcssme_project";
   	private $pass = "Z2SW7jqNVdwtvnYE";

   	public function _connect()
   	{
   		mysql_connect($this->host,$this->user,$this->pass) or die ("Can't Connect Database");
   		mysql_select_db($this->data) or die ("Can't Select Database");
   		mysql_query("SET utf8 COLLATE utf8_general_ci");
   		mysql_query("SET NAMES UTF8");
   		return true;
   	}

    public function dbms_Insert($sql_command)
    {

     if($this->_connect())
     {
      $result = mysql_query($sql_command);
      if ($result)
      {
       return true;
     }
     else
     {
       die('Invalid query: ' . mysql_error());
       return false;
     }
   }
   else
   {
    return fales;
  }
}

public function dbms_Update($sql_command)
{
 if($this->_connect())
 {
  $result = mysql_query($sql_command);
  if ($result)
  {
   return true;
 }
 else
 {
   die('Invalid query: ' . mysql_error());
   return false;
 }
}
else
{
  return fales;
}
}

public function dbms_Delete($sql_command)
{
 if($this->_connect())
 {

  $result = mysql_query($sql_command);
  if ($result)
  {
   return true;
 }
 else
 {
   die('Invalid query: ' . mysql_error());
   return false;
 }
}
else
{
  return fales;
}
}


public function dbms_Select($sql_command)
{
  if($this->_connect())
  {
    $result = mysql_query($sql_command);
    $array_1 = array();

    while ($var = mysql_fetch_object($result))
    {
      $array_1[] = $var;
    }

    return $array_1;
  }
  else
  {
    return null;
  }
}

public function dbms_Select_nolog($sql_command)
{
  if($this->_connect())
  {
    $result = mysql_query($sql_command);
    $array_1 = array();

    while ($var = mysql_fetch_object($result))
    {
     $array_1[] = $var;
   }
   return $array_1;
 }
 else
 {
  return null;
}
}

public function dbms_header($str_url)
{
 @header('Location: ' . $str_url);
}

  // 1.3
public function dbms_insert_log($_username = 'system' , $_command , $_log_type = 'unknow')
{
  return;
  $_command  = str_replace('\'','.',$_command);
  $_command  = str_replace('SELECT','!S',$_command);
  $_command  = str_replace('INSERT INTO','!I',$_command);
  $_command  = str_replace('UPDATE','!U',$_command);
  $_command  = str_replace('DELETE','!D',$_command);
  $_command  = str_replace('FROM','!F',$_command);
  $_command  = str_replace('WHERE','!W',$_command);
  $_command  = str_replace('ORDER BY','!Ob',$_command);
  $_command  = str_replace('LIMIT','!L',$_command);
  $_command  = str_replace('DESC','!De',$_command);
  $_command  = str_replace('ASC','!As',$_command);
  $_command  = str_replace('VALUES','!V',$_command);
  $_command  = str_replace('script','!St',$_command);
  $_command  = str_replace('CURRENT_TIMESTAMP','!C_TIME',$_command);

  $sql_command = "INSERT INTO `log_system_tb` 
  (`log_sys_id`, `log_sys_date`, `log_sys_username`, `log_sys_command`, `log_sys_type`)
  VALUES (NULL, CURRENT_TIMESTAMP, '". $_username ."', '". $_command ."', '". $_log_type ."');";

  if($this->_connect())
  {
    $result = mysql_query($sql_command);
    if ($result)
    {
      return true;
    }
    else
    {
      die('Invalid query: ' . mysql_error());
      return false;
    }
  }
  else
  {
    return fales;
  }
}

public function dbms_subString ($var , $length = 25 )
{
  $str = $var;
  if(strlen($str) > $length )
  {
    $str = iconv_substr( $str,0,$length,"UTF-8");
    $str = $str . "...";
    return $str;
  }
  else
  {
    return $str;
  }
}

}
?>