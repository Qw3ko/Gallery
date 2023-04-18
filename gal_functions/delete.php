<?php
// Удалить картинку
require_once 'function.php';
$file = $_GET["file"];
$link = connect();
$query_small = "DELETE FROM small WHERE designation = '$file'";
$query_big = "DELETE FROM big WHERE designation = '$file'";
$result_small = mysqli_query($link, $query_small) or die(mysqli_error($link));
$result_big = mysqli_query($link, $query_big) or die(mysqli_error($link));
$file_small = '../img_small' . '/' . $file;
$file_big = '../img_big' . '/' . $file;
unlink($file_small);
unlink($file_big);
header('Location: /');
?>