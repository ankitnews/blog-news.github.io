<?php include 'header.php';?>

    <div id="main-content">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <!-- post-container -->
                    <div class="post-container">
                        <?php 
                        include"config.php";
                        $limit= 3;
                        if(isset($_GET['page'])){
                        $page=$_GET['page'];
                        }
                        else{
                        $page=1;
                        }
                        $offset=($page-1)* $limit;
                         $sql="SELECT post.title,user.username,user.role,post.post_date,post.description,post.post_id,post.post_img FROM post LEFT JOIN category ON post.post_id = category.category_id LEFT JOIN user ON post.author = user.user_id ORDER BY post.post_id  LIMIT {$offset} , {$limit} " ;
                        $result=mysqli_query($conn,$sql);
                        while ($row=mysqli_fetch_assoc($result)) { ?>
                        <div class="post-content">
                            <div class="row">
                                <div class="col-md-4">
                                    <a class="post-img"  href="single.php"><img src="admin/upload/<?php echo $row['post_img']; ?>"  alt=""/></a>
                                </div>
                                <div class="col-md-8">
                                    <div class="inner-content clearfix">
                                        <h3><a href='single.php'><?php echo $row['title']; ?></a></h3>
                                        <div class="post-information">
                                            <span>
                                                <i class="fa fa-tags" aria-hidden="true"></i>
                                                <a href='category.php'>PHP</a>
                                            </span>
                                            <span>
                                                <i class="fa fa-user" aria-hidden="true"></i>
                                                <?php 
                                                if ($row['role']==1) {
                                                  echo '<a href="author.php">Admin</a>';  
                                                }
                                                else{ ?>
                                                  <a href="author.php"><?php echo $row['username']; ?></a>  
                                                <?php }
                                                 ?>
                                                
                                                
                                            </span>
                                            <span>
                                                <i class="fa fa-calendar" aria-hidden="true"></i>
                                                <?php echo $row['post_date']; ?>
                                            </span>
                                        </div>
                                        <p class="description">
                                           <?php echo $row['description']; ?>
                                        </p>
                                        <a class='read-more pull-right' href='single.php?read_id=<?php echo $row['post_id']; ?>'>read more</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                        <ul class='pagination'>
                            <?php $sql1="SELECT * FROM post";
                            $result1=mysqli_query($conn,$sql1);
                            $row1=mysqli_fetch_assoc($result1);
                            $total_record=count($row1);
                            $total_page=ceil($total_record/$limit);
                           
                            
                            for($i=1;$i<=$total_page;$i++) {
                                if($i==$page){
                                    $active="active";
                                }
                                else{
                                    $active="";
                                }
                                ?>

                        <li class="<?php echo $active; ?>"><a href="index.php?page=<?php echo $i; ?>"><?php echo $i; ?></a></li>
                        <?php }
                            ?>
                            
<!-- 
                            <li class="active"><a href="">1</a></li>
                            <li><a href="">2</a></li>
                            <li><a href="">3</a></li> -->
                        </ul>
                    </div><!-- /post-container -->
                </div>
                <?php include 'sidebar.php'; ?>
            </div>
        </div>
    </div>
<?php include 'footer.php'; ?>
