<?php
include'config.php';
if(isset($_FILES['fileToUpload'])){
$errors=array();
$file_name=$_FILES['fileToUpload']['name'];
$file_size=$_FILES['fileToUpload']['size'];
$file_tmp=$_FILES['fileToUpload']['tmp_name'];
$file_type=$_FILES['fileToUpload']['type'];

	move_uploaded_file($file_tmp,"upload/".$file_name);

}
$post_title=$_POST['post_title'];
$postdesc=$_POST['postdesc'];
$category=$_POST['category'];
$date=date("d M, Y");
session_start();
$author=$_SESSION['user_id'];
$sql="INSERT INTO post (title,description,category,post_date,author,post_img) VALUES('{$post_title}','{$postdesc}','{$category}','{$date}',{$author},'{$file_name}');";

$sql.="UPDATE category SET post= post + 1 WHERE category_id={$category}";
if(mysqli_multi_query($conn,$sql)){
header("Location:http://localhost/news-site/admin/post.php");
}
else{
	echo "Query failed please check";
}
?>