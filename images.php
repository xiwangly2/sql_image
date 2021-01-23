<?php
include_once './sql_image_config.php';
//创建连接
$conn = new mysqli($host,$sqlusername,$password,$dbname);
if($conn->connect_error){
	die("连接失败: " . $conn->connect_error);
}
//$sql = "SELECT name,type,id,bin FROM $tablename";
//$result = $conn->query($sql);
$sql = "SELECT count(*) FROM $tablename";
$result = $conn->query($sql);
$rows = mysqli_fetch_row($result);
$rowcount = $rows[0];
$ci = @rand(1,$rowcount);
$sql = "SELECT * from $tablename WHERE id={$ci}";
$result = $conn->query($sql);
$rows = mysqli_fetch_array($result);
$sql_name = $rows["name"];
$sql_type = $rows["type"];
$sql_bin = $rows["bin"];
$sql_info = @getimagesize($sql_bin);
$sql_mime = $sql_info["mime"];
if($mime == "image/png")
{
	header("Content-Type:image/png");
}
elseif($mime == "image/jpeg")
{
	header("Content-Type:image/jpeg");
}
elseif($mime == "image/gif")
{
	header("Content-Type:image/gif");
}
elseif($mime == "image/vnd.wap.wbmp")
{
	header("Content-Type:image/vnd.wap.wbmp");
}
elseif($mime == "image/x-xbitmap")
{
	header("Content-Type:image/x-xbitmap");
}
elseif($mime == "image/webp")
{
	header("Content-Type:image/webp");
}
elseif($mime == "image/bmp")
{
	header("Content-Type:image/bmp");
}
else
{
	header("Content-Type:image/png");
}
echo($sql_bin);
$conn->close();
?>