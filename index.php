 <!doctype html>
<html lang="zh">
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
  <form action="" method="post" enctype="multipart/form-data">
    <span class="fileinput-button"> <a id="fileName">添加照片</a>
    <input type="file" name="file" id="file" onchange="handleFile()"/>
    </span> <br>
    <button style="width:20%;margin-top:20px;margin-bottom:40px" class="login-btn"  type="sumbit" name="upload" id="load-btn" value="上传">发射</button>
  </form>
</body>
</html>
<?php   
require_once("qiniu/io.php");
require_once("qiniu/rs.php");
if($_POST['upload']=='上传'){
$bucket = "";
$key1 =  $_FILES["file"]["name"] ;
$accessKey = '';  //换成你自己的密钥
$secretKey = '';    //换成你自己的密钥

Qiniu_SetKeys($accessKey, $secretKey);
$putPolicy = new Qiniu_RS_PutPolicy($bucket);
$upToken = $putPolicy->Token(null);
$putExtra = new Qiniu_PutExtra();
$putExtra->Crc32 = 1;
list($ret, $err) = Qiniu_PutFile($upToken, $key1,$_FILES["file"]["tmp_name"], $putExtra);
echo "====> Qiniu_PutFile result: \n";
if ($err !== null) {
    var_dump($err);
} else {
    var_dump($ret);
}
if ($_FILES["file"]["error"] > 0)
  {
  echo "Error: " . $_FILES["file"]["error"] . "<br />";
  }
else
  {
  echo "Upload: " . $_FILES["file"]["name"] . "<br />";
  echo "Type: " . $_FILES["file"]["type"] . "<br />";
  echo "Size: " . ($_FILES["file"]["size"] / 1024) . " Kb<br />";
  echo "Stored in: " . $_FILES["file"]["tmp_name"];
  }
}
?>

