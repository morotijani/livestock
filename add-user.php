<?php include 'setting/system.php'; ?>
<?php include 'theme/head.php'; ?>
<?php include 'theme/sidebar.php'; ?>
<?php include 'session.php'; ?>

<!-- !PAGE CONTENT! -->
<div class="w3-main" style="margin-left:300px;margin-top:43px;">

  <!-- Header -->
  <header class="w3-container" style="padding-top:22px">
    <h5><b><i class="fa fa-dashboard"></i>User > Add</b></h5>
  </header>
 
 <?php include 'inc/data.php'; ?>

 
 <div class="w3-container" style="padding-top:22px">
 <div class="w3-row">
 	<h2>Add New user</h2>

 	<div class="col-md-6">
      
      <?php
      
       //$n_username = $n_password  = "";

      if(isset($_POST['submit'])) {      
        $n_username = ($_POST['username']);
	    $n_password = ($_POST['password']);
    

      /*  function sanitize_user($data) {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
          }*/
          $hashed_pass= sha1($n_password);
        //$hashed_pass = password_hash($n_password,PASSWORD_DEFAULT);

      	$insert = $db->query("INSERT INTO admin(username,password) VALUES('$n_username','$hashed_pass ') ");

      	if($insert){?>

      	<div class="alert alert-success alert-dismissable">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
             <strong>User Created successfully <i class="fa fa-check"></i></strong>
        </div>

       <?php

      	}else{ ?>

          <div class="alert alert-danger alert-dismissable">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
             <strong>Error creatiing user. Please try again <i class="fa fa-times"></i></strong>
        </div>
      	<?php
      }
      
      }

     ?>




 		<form method="post" autocomplete="off" >
 			<div class="form-group">
	 			<label class="control-label">Username.</label>
	 			<input type="text" name="username" class="form-control" required>
	 		</div>

             <div class="form-group">
	 			<label class="control-label">Password</label>
	 			<input type="text" name="password" class="form-control" required>
	 		</div>

	 		<button name="submit" type="submit" name="submit" class="btn btn-sn btn-default">Add User</button>
 		</form>
 	</div>
 </div>
</div>

</div>
<?php include 'theme/foot.php'; ?>