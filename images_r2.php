<?php
include_once './sql_image_config.php';
//创建连接
$conn = new mysqli($host,$sqlusername,$password,$dbname);
if($conn->connect_error){
	die("连接失败: " . $conn->connect_error);
}
$ci = $_GET['p'];
$sql = "SELECT * from $tablename WHERE id={$ci}";
$result = $conn->query($sql);
$rows = @mysqli_fetch_array($result);
$sql_name = $rows["name"];
$sql_type = $rows["type"];
$sql_bin = $rows["bin"];
$sql_info = @getimagesize($sql_bin);
$sql_mime = $sql_info["mime"];
@header("Content-Type:$sql_mime");
$conn->close();
echo($sql_bin);
?>
