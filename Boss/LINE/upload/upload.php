<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
<link rel="stylesheet" media="all" href="./css/jquery.dataTables.css">
<link rel="stylesheet" media="all" href="./css/mdb.css">
<link href="./css/font-awesome.min.css" rel="stylesheet">
<script src="./js/jquery-latest.min.js" type="text/javascript"></script>
<script src="./js/tableSort.js" type="text/javascript"></script>
      <title>圖片上傳器</title>
<script>
</script>
<style type="text/css">
.auto-style1 {
	text-align: center;
}
.auto-style2 {
	color: #FF0000;
}
.auto-style3 {
	color: #000000;
}
</style>
   </head>
   <body>
   <div id="maincontainer">
	<div id="nav">
		<ul>
			<li><a href="https://tx9vs5swfgjw9nqh1z3gyw-on.drv.tw/iruna/irunadata.html">Iruna交易板</li>
			<li><a href="https://tx9vs5swfgjw9nqh1z3gyw-on.drv.tw/iruna/datainput.html">交易物品登陸</li>
			<li style="background-color: #f3f3f3;"><a href="https://googledrive.com/host/0B10VsvhVUeZ5VlUycG1hWjdYYjA/produce.html"><strong>圖片上傳器</strong></a></li>
                        <li><a href="">未分類</a></li>
			<li><a href="">未分類</a></li>
		</ul>
	</div>
	<br clear="all">
	<h1 class="auto-style1"></h1>
		<br clear="all"><br>
	<div id='pagecontainer' class="hide">
		<div class='prev'>
		</div>
		<div id='paging'>
		</div>
		<div class='next'>
		</div>
	</div>
	</div>
      <!-- Start Formoid form-->
      <link rel="stylesheet" href="formoid_files/formoid1/formoid-flat-red.css" type="text/css" />
      <script type="text/javascript" src="formoid_files/formoid1/jquery.min.js"></script>
      <div enctype="multipart/form-data" class="formoid-flat-red" style="background-color:#FFFFFF;font-size:14px;font-family:'Lato', sans-serif;color:#666666;max-width:480px;min-width:150px" method="post">
         <div class="title">
            <h2>圖片上傳器<img src="https://i.imgur.com/p0ZUih1.png" width="32"></h2>
         </div>
<?php
$puaruvn = basename($_FILES["fileToUpload"]["name"]);
$puarupham = strtolower(pathinfo($puaruvn,PATHINFO_EXTENSION));
if($puarupham != "jpg" && $puarupham != "png" && $puarupham != "jpeg"
&& $puarupham != "gif" ) {
	echo '<div class="element-input"><label class="title">網址</label><input class="large" type="text" name="input" value="僅限附檔名為 JPG, JPEG, PNG 及 GIF 的檔案喔。" /></div>';
}
else
{
	$img = upload($_FILES["fileToUpload"]["tmp_name"]);
echo '<div class="element-input"><label class="title">網址</label><input class="large" type="text" name="input" value="'.$img.'" ng-model="copyvalue" /></div><button ng-click="doCopy(copyvalue);">複製</button>
<div class="element-input"><label class="title">BBCode</label><input class="large" type="text" name="input" value="[img]'.$img.'[/img]" /></div><div class="element-input"><label class="title">圖片</label><img src="'.$img.'" width="100%"></div>';
}
?>
<div class="submit"><a href="https://irunamuscelboss.herokuapp.com/Boss/LINE/upload/index.html"><input type="submit" value="返回"/></a></div>
      </div>
	   
<script type="text/javascript">
doCopy(value) {
    const input = document.querySelector('.copyInput');

    input.value = value;

    // 选中赋值过的input
    input.select();

    document.execCommand('Copy');
    alert('複製成功!');
}
</script>
	   
   </body>
</html>




<?php



function upload($anh)
{
$client_id = getenv('ImgurId');
$file = file_get_contents($anh);
$url = 'https://api.imgur.com/3/image.json';
$headers = array("Authorization: Client-ID $client_id");
$pvars  = array('image' => base64_encode($file));
$curl = curl_init();
curl_setopt_array($curl, array(
   CURLOPT_URL=> $url,
   CURLOPT_TIMEOUT => 30,
   CURLOPT_POST => 1,
   CURLOPT_RETURNTRANSFER => 1,
   CURLOPT_HTTPHEADER => $headers,
   CURLOPT_POSTFIELDS => $pvars
));
$json_returned = curl_exec($curl); // blank response
$img = json_decode($json_returned,true);
return $img['data']['link'];
curl_close ($curl); 
}
?>
