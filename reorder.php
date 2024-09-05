<?php include 'setting/system.php'; ?>
<?php include 'theme/head.php'; ?>
<?php include 'theme/sidebar.php'; ?>
<?php include 'session.php'; ?>

<!-- !PAGE CONTENT! -->
<div class="w3-main" style="margin-left:300px;margin-top:43px;">

  <!-- Header -->
  <header class="w3-container" style="padding-top:22px">
    <h5><b><i class="fa fa-dashboard"></i> Livestock Management</b></h5>
  </header>
 
 <?php include 'inc/data.php'; ?>

 
 <div class="w3-container" style="padding-top:22px">
 <?php


if ($_POST) {
    if (!empty($_POST['buy'])) {
        $reorder = time();
        $buy_ids = [$_POST['buy']];
        $new_price = $_POST['new_price'];

        $idss = 0;
        foreach ($buy_ids as $id) {
            $idss = implode(',', $id);
        }

        $insert = $db->query("INSERT INTO reorder (reorder_id, livestock_id, new_amount) VALUES ('$reorder', '$idss', '$new_price')");
        if ($insert) {

            for ($i = 0; $i <= count($buy_ids); $i++) {
                $updateQuery = $db->query("UPDATE livestock SET sale_status = 'Sold' WHERE id = '$id[$i]'");
            }

            echo '<div class="alert alert-success alert-dismissable">
              <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
               <strong>Re-order made successfully <i class="fa fa-check"></i></strong>
          </div>';
  
  
            } else {
  
            echo '<div class="alert alert-danger alert-dismissable">
              <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
               <strong>Error creating re-order. Please try again <i class="fa fa-times"></i></strong>
          </div>';
        }
    }
  
}



?>

 <div class="w3-row">
    <form method="POST" action="reorder.php" id="buyForm">
        <h2>Manage Re-Order</h2>
        <a href="reorder.php" style="margin-left: 10px" class="btn btn-sm btn-danger pull-right">Cancel re-order</a><br><br>

        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Complete re-order</h4>
                    </div>
                    <div class="modal-body">
                        <p class="lead"> You are to a bulk purchase of livesctock</p>
                        <!-- <br>
                        Actual total purchase amount is: <span id=""></span>
                        <br> -->
                        <div class="form-group">
                            <label for="">New amount to be sold:</label>
                            <input type="text" class="form-control" name="new_price">
                        </div>
                        </div>
                    <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    <button id="submit-reorder" onClick="submit_reorder()" class="btn btn-primary">Purchase</button>
                    </div>
                </div>
            </div>
        </div>

    <div class="table-responsive">
 	    <table class="table table-hover table-striped" id="table">
 		    <thead>
 			    <tr>
 				    <th>S/N</th>
                    <th>Photo</th>
                    <th>Livestock No.</th>
                    <th>Type</th>
                    <th>Breed</th>
                    <th>Weight</th>
                    <th>Gender</th>
                    <th>Arrived</th>
                    <th></th>
 				    <th>Desc.</th>
                    <th></th>
 			    </tr>
 		    </thead>
 		    <tbody>
            <?php
                $all_pig = $db->query("SELECT * FROM livestock WHERE reorder = 1 AND sale_status = 'Unsold' ORDER BY id DESC");
                $fetch = $all_pig->fetchAll(PDO::FETCH_OBJ);
                foreach ($fetch as $data) { 
                    $get_breed = $db->query("SELECT * FROM breed WHERE id = '$data->breed_id'");
                    $breed_result = $get_breed->fetchAll(PDO::FETCH_OBJ);
                    foreach ($breed_result as $breed) {
            ?>
          <tr>
                <td>
                    <input type="checkbox" id="buy_<?php echo $data->id ?>" name="buy[]" value="<?php echo $data->id ?>">
                    <?php echo $data->id ?></td>
                <td>
                <img width="70" height="70" src="<?php echo $data->img; ?>" class="img img-responsive thumbnail">
                </td>
                <td>
                <?= $data->livestockno; ?>
                </td>
                <td><?= $data->type ?></td>
                <td><?= $breed->name ?></td>
                <td><?= $data->weight ?></td>
                <td><?= $data->gender ?></td>
                <td><?= $data->arrived ?></td>
                <td>
                    <!-- Button trigger modal -->
                    <?php if ($data->sale_status != 'Sold') : ?>
                        <?= 'GH₵' . number_format($data->sale_amount, 2); ?>
                    
                    <?php else: ?>
                    <button type="button" class="btn btn-warning" disabled>Sold</button>
                    <?php endif; ?>
                </td>
            <td><?= wordwrap($data->remark, 300, '<br>'); ?></td>
            <td>
               <div class="dropdown">
                  <button class="btn btn-sm btn-default dropdown-toggle" type="button" data-toggle="dropdown"><i class="fa fa-cog"></i> Option
                  <span class="caret"></span></button>
                  <ul class="dropdown-menu">
                    <li><a href="edit-livestock.php?id=<?php echo $data->id ?>"><i class="fa fa-edit"></i> Edit</a></li>
                    <li><a onclick="return confirm('Continue delete livestock ?')" href="delete.php?id=<?php echo $data->id ?>"><i class="fa fa-trash"></i> Delete</a></li>
                    <li><a onclick="return confirm('Continue quarantine livestock ?')" href="quarantine.php?id=<?php echo $data->id; ?>"><i class="fa fa-paper-plane"></i> Quarantine livestock</a></li>
                  </ul>
                </div> 
            </td>
          </tr> 
      <?php 
       }
      }
      ?>
 		</tbody>
 	</table>
 </div>
    </form>
 </div>
</div>


</div>


<?php include 'theme/foot.php'; ?>
<script>
    function submit_reorder() {
        alert('in');
        $('#buyForm').submit();
    }
</script>