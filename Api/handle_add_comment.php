<?php 
session_start();
require_once('conn.php');
require_once("utils.php");

if(
empty($_POST['content'])
){
  header("Location: index.php?errCode=1");
  die('資料不齊全');
}

// $user = getUserFromUsername($_SESSION['username']);
// $nickname = $user['nickname'];
$username = $_SESSION['username'];

$content = $_POST['content'];
// $sql = "insert into lidemy(username) values('".$username."')";

// $sql = sprintf(
//   "insert into comments(nickname, content) 
//   values('%s','%s')",$nickname,$content
// );

$sql ="insert into comments(username, content) 
  values(?,?)";
$stmt= $conn->prepare($sql);
$stmt->bind_param('ss',$username,$content);
$result = $stmt->execute();
if(!$result){
  die($conn->error);
}
header("Location: index.php");
?>
