<?php
  session_start();
  $_SESSION['account']="Leo5566";
  $_SESSION['password']="123456";
  echo "success!";
 ?>
 <!DOCTYPE html>
 <html lang="en" dir="ltr">
   <head>
     <meta charset="utf-8">
     <title>阿偉</title>
   </head>
   <body>
     <div class="">
       我是首頁!
     </div>
     <a href="showsession.php">登入</a>
   </body>
 </html>
