<?php 
include "config.php";
$cate_id=$_POST['cat_id'];
$cat_name=$_POST['cat_name'];
$sql="UPDATE category SET category_name='{$cat_name}' WHERE category_id={$cate_id}";
mysqli_query($conn,$sql);
header("location:http://localhost/news-site/admin/category.php");
?>