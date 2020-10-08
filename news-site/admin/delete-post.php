<?php 
include"config.php";
$del_id=$_GET['id'];
$sql1 = "SELECT * FROM post WHERE post_id ={$del_id}";
$result=mysqli_query($conn,$sql1);
$row=mysqli_fetch_assoc($result);
unlink("upload/".$row['post_img']);
$sql= "DELETE FROM post WHERE post_id ={$del_id} ";
if(mysqli_query($conn,$sql)){
	header("Location:http://localhost/news-site/admin/post.php");

}


?>