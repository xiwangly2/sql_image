<?php
include_once './sql_image_config.php';
$img = @file_get_contents($url);
$uuid = uniqid();
@file_put_contents("{$uuid}imgdata.bin",$img);
$info = @getimagesize("{$uuid}imgdata.bin");
$md5 = @md5_file("{$uuid}imgdata.bin");
$mime = $info["mime"];
if($mime == "image/png"){
	$filetype = ".png";
}
elseif($mime == "image/jpeg"){
	$filetype = ".jpeg";
}
elseif($mime == "image/gif"){
	$filetype = ".gif";
}
elseif($mime == "image/vnd.wap.wbmp"){
	$filetype = ".wbmp";
}
elseif($mime == "image/x-xbitmap"){
	$filetype = ".xbm";
}
elseif($mime == "image/webp"){
	$filetype = ".webp";
}
elseif($mime == "image/bmp"){
	$filetype = ".bmp";
}
else
{
	$filetype = ".bin";
}
$filename = "{$md5}{$filetype}";
if(!isset($mime) || $mime == ''){
	die('error,no mime');
}
//创建连接
$conn = new mysqli($host,$sqlusername,$password,$dbname);
if($conn->connect_error){
	die("连接失败: " . $conn->connect_error);
}
//$sql = "SELECT name,type,id,bin FROM $tablename";
//$conn->query($sql);
$bin = mysqli_escape_string($conn,$img);
if(!isset($bin) || $bin == ''){
	die('error');
}
$sql = "SELECT count(*) FROM $tablename";
$result = $conn->query($sql);
$rows = mysqli_fetch_row($result);
$rowcount = $rows[0];
$ci = $rowcount + '1';
//$sql = "DELETE FROM $tablename WHERE name=\"{$filename}\"";
//$conn->query($sql);
$sql = "INSERT INTO $tablename (name,type,id,bin)VALUES (\"{$filename}\",\"{$mime}\",\"{$ci}\",\"{$bin}\")";
$conn->query($sql);
echo($filename.' OK');
$conn->close();
@unlink("{$uuid}imgdata.bin");
?>