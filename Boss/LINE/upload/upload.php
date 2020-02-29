<!DOCTYPE html>
<html>
   <head>
      <meta charset="utf-8" />
      <title>肌肉老大圖片上傳器</title>
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
   </head>
   <body class="blurBg-false" style="background-color:#EBEBEB">
      <!-- Start Formoid form-->
      <link rel="stylesheet" href="formoid_files/formoid1/formoid-flat-red.css" type="text/css" />
      <script type="text/javascript" src="formoid_files/formoid1/jquery.min.js"></script>
      <div enctype="multipart/form-data" class="formoid-flat-red" style="background-color:#FFFFFF;font-size:14px;font-family:'Lato', sans-serif;color:#666666;max-width:480px;min-width:150px" method="post">
         <div class="title">
            <h2>肌肉老大圖片上傳器<img src="https://i.imgur.com/p0ZUih1.png" width="32"></h2>
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
echo '<div class="element-input"><label class="title">網址</label><input class="large" type="text" name="input" value="'.$img.'" /></div><div class="element-input"><label class="title">BBCode</label><input class="large" type="text" name="input" value="[img]'.$img.'[/img]" /></div><div class="element-input"><label class="title">圖片</label><img src="'.$img.'" width="100%"></div>';
}
?>
<div class="submit"><a href="https://irunamuscelboss.herokuapp.com/Boss/LINE/upload/index.html"><input type="submit" value="返回"/></a></div>
      </div>
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
