<?php 
include "config.php";
 $cat_did=$_GET['cat_did'];
$sql="DELETE FROM category WHERE category_id={$cat_did}";
$result=mysqli_query($conn,$sql);
if($result==1){
	echo "Succes Fully delete category"; ?>
	<a href="location:http://localhost/news-site/admin/category.php">Category page</a>
<?php
}
?>