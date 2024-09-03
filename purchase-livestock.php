<?php include 'setting/system.php'; ?>
<?php include 'theme/head.php'; ?>
<?php include 'theme/sidebar.php'; ?>
<?php include 'session.php'; ?>

<?php 
 if(!$_GET['id'] OR empty($_GET['id']) OR $_GET['id'] == '')
 {
 	header('location: manage-livestock.php');

 }else{
 	
 	$id = (int)$_GET['id'];
 	$updateQuery = $db->query("UPDATE livestock SET sale_status = 'Sold' WHERE id = '$id' ");

 }

?>
<!-- !PAGE CONTENT! -->
<div class="w3-main" style="margin-left:300px;margin-top:43px;">

  <!-- Header -->
  <header class="w3-container" style="padding-top:22px">
    <h5><b><i class="fa fa-dashboard"></i> Livestock Management</b></h5>
  </header>
 
 <?php include 'inc/data.php'; ?>

 <?php if($updateQuery){?>
      	<div class="alert alert-success alert-dismissable">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
             <strong>Livestock successfully Purchased <i class="fa fa-check"></i></strong>
        </div>
       <?php
      	}else{ ?>
          <div class="alert alert-danger alert-dismissable">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
             <strong>There was a problem purchaing livestock. Please try again <i class="fa fa-times"></i></strong>
        </div>
      	<?php
      }

     ?>


</div>

<?php include 'theme/foot.php'; ?>