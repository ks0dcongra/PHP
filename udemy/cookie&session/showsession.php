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
session_start();
echo $_SESSION['account']."</br>".$_SESSION['password'];

 ?>
 <div>會員限定內容，請先登入才能觀看</div>
</body>
</html>
