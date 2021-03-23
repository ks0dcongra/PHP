<html>
<meta charset="UTF-8">
<body>
  <form action="getDate.php" method="POST">
    <div class="">姓</div>
      <input type="text" name="firstname"/>
    <div class="">名</div>
      <input type="text" name="name"/>
    <div class="">電話</div>
      <input type="text" name="number"/ maxlength="10">
    <div class="">住址</div>
      <input type="text" name="location"/>
    <div class="">信箱</div>
      <input type="text" name="mail"/>
    <div class="">帳號</div>
      <input type="text" name="account"/ maxlength="15">
    <div class="">密碼</div>
      <input type="text" name="password"/ maxlength="15">
    </br>
    </br>
    <input type="submit" name="submit" value="送出"/>
  </form>
  <div style="background-color:black; position:absolute; bottom:0;width:100%;height:60px;
  color:white;padding:15;text-align:center;">
  <?php
    echo "©".date("Y");
   ?>
   Cable News Network.A Warner Media Company.All Rights Reserved.
  </div>
</body>
</html>
