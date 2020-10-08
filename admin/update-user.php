<?php include "header.php"; 
include "config.php";
if (isset($_POST['submit'])) {
 
  $us_id=$_POST['user_id'];
  $fname=mysqli_escape_string($conn,$_POST['f_name']);
  $lname=mysqli_escape_string($conn,$_POST['l_name']);
  $user=mysqli_escape_string($conn,$_POST['username']);
  $role=mysqli_escape_string($conn,$_POST['role']);
  $sql1="UPDATE user SET first_name='{$fname}',last_name='{$lname}',username='{$user}',role='{$role}'
  WHERE user_id={$us_id}";
  mysqli_query($conn,$sql1);
}
?>
  <div id="admin-content">
      <div class="container">
          <div class="row">
              <div class="col-md-12">
                  <h1 class="admin-heading">Modify User Details</h1>
              </div>
              <div class="col-md-offset-4 col-md-4">
                  <!-- Form Start -->
                  <?php
                  
                  $users_id=$_GET['id'];
                  $sql="SELECT * FROM user WHERE user_id={$users_id}";
                  $result=mysqli_query($conn,$sql);
                  while($row=mysqli_fetch_assoc($result)){ ?>
                  <form  action="" method ="POST">
                      <div class="form-group">
                          <input type="hidden" name="user_id"  class="form-control" value="<?php echo $row['user_id'] ?>" placeholder="" >
                      </div>
                          <div class="form-group">
                          <label>First Name</label>
                          <input type="text" name="f_name" class="form-control" value="<?php echo $row['first_name'] ?>" placeholder="" required>
                      </div>
                      <div class="form-group">
                          <label>Last Name</label>
                          <input type="text" name="l_name" class="form-control" value="<?php echo $row['last_name'] ?>" placeholder="" required>
                      </div>
                      <div class="form-group">
                          <label>User Name</label>
                          <input type="text" name="username" class="form-control" value="<?php echo $row['username'] ?>" placeholder="" required>
                      </div>
                      <div class="form-group">
                          <label>User Role</label>
                          <select class="form-control" name="role">
                            <?php $sql1="SELECT * FROM user";
                            $result1=mysqli_query($conn,$sql1);
                            while($row1=mysqli_fetch_assoc($result1)){ ?>
                              <?php if($row['user_id']==$row1['user_id']){
                                $select="selected";
                              }
                              else{
                                $select="";
                              } 
                              ?>
                            <?php echo "<option {$select} value='{$row1['user_id']}'>{$row1['username']}</option>"; ?>
                          <?php } ?>
                          </select>
                      </div>
                      <input type="submit" name="submit" class="btn btn-primary" value="Update" required />
                  </form>
                  <!-- /Form -->
                <?php } ?>
              </div>
          </div>
      </div>
  </div>
<?php include "footer.php"; ?>
