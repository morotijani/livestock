
<?php include 'setting/db.php'; 
error_reporting(0);

?>
<style>
body{
  background-image:url('img/background-01.jpg');
  background-repeat: no-repeat;
  background-size: cover;

}
</style>

<?php include 'setting/system.php'; ?>
<?php include 'theme/head.php'; ?>


<div class="container">
	<div class="row" style="margin-top: 10%">

		<h1 class="text-center"><?php echo NAME_X; ?></h1><br>
   <div class="col-md-2 col-md-offset-2">
     <!--<img src="img/livestock.png" alt="livestock pic" class="img img-responsive">-->
   </div>
		<div class="col-md-4">
			<form method="post" autocomplete="off">
				<div class="form-group">
				   <label class="control-label">Username</label>
				   <input type="text" name="username" class="form-control input-sm" required>
			    </div>

			    <div class="form-group">
				   <label class="control-label">Password</label>
				   <input type="password" name="password" class="form-control input-sm" required>
			    </div>
          <div class="form-group">
				   
				  
                
			    <button name="submit" type="submit" class="btn btn-md btn-dark">Log in</button>
			</form>
  

			<?php
            if (isset($_POST['submit'])){

                $username = input_validate($_POST['username']);
              	$password = input_validate($_POST['password']);


              	$hash = sha1($password);


                
                
                $q = $db->query("SELECT * FROM admin WHERE username = '$username' AND password = '$hash' LIMIT 1 ");

                $count = $q->rowCount();
                $rows = $q->fetchAll(PDO::FETCH_OBJ);

                if($count > 0){
                   foreach($rows as $row){
                     $user_id = $row->id;
                     $user = $row->username;

                     $_SESSION['id'] = $user_id;
                     $_SESSION['user'] = $user;

                     header('location: dashboard.php');
                   }
                }else{
                	$error = 'incorrect login details';
                }                           
            }

            if(isset($error)){ ?>
            <br><br>
               <div class="alert alert-danger alert-dismissable">
                  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                  <strong><?php echo $error; ?>.</strong>
              </div>
            <?php }

function input_validate($input_data){
  $input_data=trim($input_data);
  $input_data=stripslashes($input_data);
  $input_data=htmlspecialchars($input_data);
  return  $input_data;

} 
			?>


		</div>
	</div>
</div>


<?php include 'theme/foot.php'; ?>
