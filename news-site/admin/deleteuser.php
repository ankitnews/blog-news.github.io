<?php
include "header.php";
  include'config.php';
    $del_id=$_GET['id'];
    $sqldel="DELETE FROM user WHERE user_id={$del_id} ";
    mysqli_query($conn,$sqldel);
    header("Location:http://localhost/news-site/admin/users.php");
    ?>