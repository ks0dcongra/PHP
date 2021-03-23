<?php

  //menu
  include 'menu.php';
  //content
  include 'content.php';
  //footer
  include 'footer.php';

  $date = new DateTime('2018-02-28');
  echo date_format($date, 'Y-m-d');
  echo"</br>";
  echo pow(10, 2);
  function powl($a,$b)
  {

    echo $a ** $b;

  }
  echo"</br>";
  powl(10,2);

  echo abs(-10);
 ?>
