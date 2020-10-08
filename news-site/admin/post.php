<?php include "header.php";
include 'config.php'; 
$limit= 3;
if(isset($_GET['page'])){
$page=$_GET['page'];
}
else{
  $page=1;
}
$offset=($page-1)* $limit;
$sql="SELECT post.post_id,category.category_id,post.title,category.category_name ,post.post_date ,user.role,user.username FROM post LEFT JOIN category ON post.category =category.category_id LEFT JOIN user ON post.author=user.user_id  ORDER BY post.post_id DESC LIMIT {$offset}, {$limit}";
$result=mysqli_query($conn,$sql);
?>

  <div id="admin-content">
      <div class="container">
          <div class="row">
              <div class="col-md-10">
                  <h1 class="admin-heading">All Posts</h1>
              </div>
              <div class="col-md-2">
                  <a class="add-new" href="add-post.php">add post</a>
              </div>
              <div class="col-md-12">
                  <table class="content-table">
                      <thead>
                          <th>S.No.</th>
                          <th>Title</th>
                          <th>Category</th>
                          <th>Date</th>
                          <th>Author</th>
                          <th>Edit</th>
                          <th>Delete</th>
                      </thead>
                      <tbody>
                        <?php while ($row=mysqli_fetch_assoc($result)) {?>
                          <tr>

                              <td class='id'><?php echo $row['post_id']; ?></td>
                              <td><?php echo $row['title']; ?></td>
                              <td><?php echo $row['category_name']; ?></td>
                              <td><?php echo $row['post_date']; ?></td>
                              <?php if($row['role']==1 ){ ?>
                              <td>Admin(<?php echo $row['username']; ?>)</td>
                            <?php } ?>
                            <?php if($row['role']==0) {?>
                              <td>Normal User(<?php echo $row['username']; ?>)</td>
                            <?php } ?>
                              <td class='edit'><a href='update-post.php?id=<?php echo $row['post_id']; ?>'><i class='fa fa-edit'></i></a></td>
                              <td class='delete'><a href='delete-post.php?id=<?php echo $row['post_id']; ?>&cat_id=<?php echo $row['category_id']; ?>'><i class='fa fa-trash-o'></i></a></td>
                          </tr>
                          <?php } ?>
                      </tbody>
                  </table>
                  <?php
                   $sql1="SELECT * FROM post";
                   $result1=mysqli_query($conn,$sql1);
                   if(mysqli_num_rows($result1) > 0){
                    $total_record=mysqli_num_rows($result1);
                    $total_pages=ceil($total_record / $limit);
                   
                   echo '<ul class="pagination admin-pagination">';
                   if($page > 1){
                   echo '<li><a href="post.php?page='.($page - 1).'">Prv</a></li>';
                    }
                   for($i=1; $i<=$total_pages;$i++){
                    if($i==$page){
                      $active="active";
                    }
                    else{
                      $active="";
                    }
                    echo'<li class="'.$active.'" ><a href="post.php?page='.$i.'">'.$i.'</a></li>';
                   }
                   if($total_pages > $page){
                   echo '<li><a href="post.php?page='.($page + 1).'">Next</a></li>';
                    }
                  echo'</ul>';
                  }
                   ?>
                  
              </div>
          </div>
      </div>
  </div>
<?php include "footer.php"; 
print_r(mysqli_num_rows($result1));
?>
