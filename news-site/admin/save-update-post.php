<?php
include'config.php';
if(empty($_FILES['new-image']['name'])){
$file_name=$_POST['old-image'];
}
else{
$errors=array();
$file_name=$_FILES['new-image']['name'];
$file_size=$_FILES['new-image']['size'];
$file_tmp=$_FILES['new-image']['tmp_name'];
$file_type=$_FILES['new-image']['type'];

	move_uploaded_file($file_tmp,"upload/".$file_name);

}

$pos_id=$_POST['post_id'];
$post_title=$_POST['post_title'];
$postdesc=$_POST['postdesc'];
$category=$_POST['category'];
 $sql="UPDATE post SET title='{$post_title}',description='{$postdesc}',category={$category},post_img='{$file_name}' WHERE post_id={$pos_id}";
if(mysqli_query($conn,$sql)){
header("Location:http://localhost/news-site/admin/post.php");
}
else{
	echo "Query failed please check";
}
?>