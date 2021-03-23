<?php

  // substring
  $aa ="aaabbbcccddd";
  echo substr($aa,3,6);
  // replace
  $bb = "href='https://edition.cnn.com/2020/11/05/politics/donald-trump-election-2020/index.html'";
  echo str_replace("trump","Leo",$bb);
  // 字串相加
  // 切割字串
  $cc="手機:ffrfjieowjwjfoiejfoij3232898ufjdosjoifjaoijfia元";
  $ary;
  $aryl;
  $ary = mb_split("元",$cc);
  $dd = "a b c d e f g h i j k";
  echo "</br>";
  echo $ary[1];
  $aryl=explode(" ",$dd);
  echo "</br>";
  echo $aryl[0];
  
  // 得到字串長度
  echo "</br>";
  echo strlen($cc);
  // indexof 找某條件在字串中的位置
  echo "</br>";
  echo strpos($cc,"0",9);

  echo "</br>";
  echo substr($cc,strpos($cc,"手",0),strpos($cc,"元",0)+1);


 ?>
