<?php
  //讀取檔案
  // $file = fopen("123.txt", "r");//設定打開檔案 r讀取, a+寫入,如果不存在 新建
  // echo fread($file, filesize("123.txt"))
  // echo fgets($file);//一次讀取一行
// while(!feof($file))
// {
//   echo fgets($file)."</br>";
// }
// $file = fopen("123.txt", "a+");
// fwrite($file,"ABCDE");
// fclose($file);
echo __FILE__;
echo "<br>";
echo dirname(__FILE__);
echo "<br>";

echo dirname(dirname(__FILE__));
echo "<br>";

print_r(glob('*.php*')); //抓出所有名為php的檔案
echo "<br>";

if(file_exists('abc.html'))
{
  echo "yes";
//  unlink('123.txt');
}
else {
  echo "no";
  touch('a.html');
}
 ?>
