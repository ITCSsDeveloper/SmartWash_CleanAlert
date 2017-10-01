<?php
/* Flow Working Protection Class v1.0
   by ITCS's Developer 2015
   make date 20-12-2015
   cradit : https://www.facebook.com/GmtanBeartai2010

   Start Check $dbms
     if true  -> pass
        fales -> reject by function->printRequestError();
   For $_POST & GET
   	 check value invalid by function->CheckValue();
   	 	if != 0 -> reject by function->printValueError();
   	 	else    -> pass

   	How to Setup
   	-> inclued class into dbms class
*/
   	@session_cache_expire(10);
   	@session_start();
   
   	if(!isset($dbms)) 
   	{ 
   		echo "<center> <h1>Request Invalid... <br>";
         echo "<button onclick='goBack()' style='height: 56px; width: 116px;'>Go Back</button> ";
         echo '
         <script>
         function goBack() {
             window.history.back();
         }
         </script>';
   		exit();
   	}

   	foreach($_POST as $key => $value) 
   	{
         $_POST[$key] = addslashes(strip_tags($value));
   	}


   	foreach($_GET as $key => $value) 
   	{
         $_GET[$key] = addslashes(strip_tags($value));
   	}
   	?>