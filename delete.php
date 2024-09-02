<?php include 'setting/system.php'; ?>
<?php
error_reporting(0);
if(!$_GET['id'] OR empty($_GET['id']))
{
	header('location: manage-livestock.php');
}else
{
	$id = (int)$_GET['id'];
	$query = $db->query("DELETE FROM livestock WHERE id = $id ");
	if($query){
		header('location: manage-livestock.php');
	}
	else{
		session_start();
		$msg="<span style='color: red;' > You must tick the checkbox before you can delete</span>";
		$_SESSION['delete_error']=$msg;
	}
}

