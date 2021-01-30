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
$conn->close();
@header("Location: ./images_r2.php?p={$ci}");
?>