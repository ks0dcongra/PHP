<?php
  if(strlen($_POST["number"])!=10){

    echo "電話號碼輸入錯誤!";

  }
  else {
    echo "您好~".$_POST["firstname"].$_POST["name"]."</br>".
         "您的電話號碼是 : ".$_POST["number"]."</br>".
         "您的住址是 : ".$_POST["location"]."</br>".
         "您的信箱是 : ".$_POST["mail"]."</br>".
         "您的帳號是 : ".$_POST["account"]."</br>".
         "您的密碼是 : ".$_POST["password"]."</br>";

  }



 ?>
