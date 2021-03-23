<html>
<head>
  <style media="screen">
    .body{

      background-color: lightblue;

    }
  </style>
</head>
<body class="body">
<?php
  echo "<div style='background-color:".
  $_COOKIE["style"].
  ";color:white'>".
  $_COOKIE["user"].
  "歡迎回來!</div>";
 ?>
</body>
</html>
