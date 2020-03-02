<?php
$file = fopen("./exampleJson/test.json", "a+");
$data = array();
$data['a'] = 'test';
$data['b'] = 'bbb';
// 把PHP数组转成JSON字符串
$json_obj = json_decode($data);
// 写入文件
fwrite($file, $json_obj); 
