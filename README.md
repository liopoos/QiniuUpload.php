# 上传图片到七牛云存储简单实例 #
这是一个简单的想七牛云存储上传图片的实例

## 食用方法： ##
首先需要加入`<input>`标签，生成一个表单

    <form action="" method="post" enctype="multipart/form-data">
    <span class="fileinput-button"> <a id="fileName">添加照片</a>
    <input type="file" name="file" id="file" onchange="handleFile()"/>
    </span> <br>
    <button style="width:20%;margin-top:20px;margin-bottom:40px" class="login-btn"  type="sumbit" name="upload" id="load-btn" value="上传">发射</button>
    </form>

引入`qiniu/io.php qiniu/rs.php`两个文件

    require_once("qiniu/io.php");
    require_once("qiniu/rs.php");

然后建一个上传策略对象，将你的bucket 传入，bucket 就是你的空间名
    
    $bucket = "";

输入**accessKey**和**secretKey**

    $accessKey = '';  //换成你自己的密钥
    $secretKey = '';//换成你自己的密钥

然后调用此方法来生成上传凭证
    
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

示例页面：index.php