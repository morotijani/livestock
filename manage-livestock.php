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
        <div class="w3-row">
         	<h2>Manage Livestock</h2>
            <a href="add-livestock.php" class="btn btn-sm btn-primary pull-right"><i class="fa fa-plus"></i> Add New Livestock</a><br><br>
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
                            <th>Price</th>
                            <th>Qty</th>
 				            <th>Desc.</th>
                            <th></th>
 			            </tr>
 		            </thead>
 		            <tbody>
 			            <?php
                            $all_pig = $db->query("SELECT *, livestock.id AS lid FROM livestock INNER JOIN quarantine WHERE quarantine.livestockno != livestock.livestockno ORDER BY livestock.id DESC");
                            $fetch = $all_pig->fetchAll(PDO::FETCH_OBJ);
                            foreach($fetch as $data) {
                                $get_breed = $db->query("SELECT * FROM breed WHERE id = '$data->breed_id'");
                                $breed_result = $get_breed->fetchAll(PDO::FETCH_OBJ);
                                
                                foreach($breed_result as $breed) {
                                    
                                    $vd = strtotime($data->vaccination_date);
                                    $seven_days_before = strtotime(date("Y-m-d") . ' - 7 days');
                        ?>
                                    <tr style="background-color: <?= (($seven_days_before >= $vd) ? 'red' : ''); ?>">
                                        <td><?php echo $data->lid ?></td>
                                        <td>
                                            <img width="70" height="70" src="<?php echo $data->img; ?>" class="img img-responsive thumbnail">
                                        </td>
                                        <td>
                                            <?php echo $data->livestockno; ?>
                                            <br>
                                            <?= (($data->reorder == 1) ? '<span class="badge badge-warning">Re-order</span>' : ''); ?>
                                        </td>
                                        <td><?php echo $data->type ?></td>
                                        <td><?php echo $breed->name ?></td>
                                        <td><?php echo $data->weight ?></td>
                                        <td><?php echo $data->gender ?></td>
                                        <td>
                                            <?php 
                                                echo $data->arrived;
                                                echo '<br>';

                                                if ($seven_days_before >= $vd) {
                                                    echo '7 days to vaccination date is almost due';
                                                }

                                            ?>
                                                    
                                        </td>
                                        <td>
                                            <?php if ($data->quantity > 0) : ?>
                                                <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#myModal<?php echo $data->lid ?>">
                                                    <?php echo 'GH₵' . number_format($data->sale_amount, 2); ?>
                                                </button>
                                                <div class="modal fade" id="myModal<?php echo $data->lid ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel<?php echo $data->lid ?>">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                                <h4 class="modal-title" id="myModalLabel<?php echo $data->lid ?>">Modal title</h4>
                                                            </div>
                                                            <div class="modal-body">
                                                                <p class="lead"> You are to purchase a livestock with an ID: <?= $data->livestockno; ?></p>
                                                                <br>
                                                                Sale amount is: <?php echo 'GH₵' . number_format($data->sale_amount ,2); ?>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                                                                <a href="purchase-livestock.php?id=<?php echo $data->lid ?>" class="btn btn-primary">Purchase</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php else: ?>
                                                <button type="button" class="btn btn-warning" disabled>Sold</button>
                                            <?php endif; ?>
                                        </td>
                                        <td><?php echo $data->quantity; ?></td>
                                        <td><?php echo wordwrap($data->remark, 300, '<br>'); ?></td>
                                        <td>
                                            <div class="dropdown">
                                                <button class="btn btn-sm btn-default dropdown-toggle" type="button" data-toggle="dropdown"><i class="fa fa-cog"></i> Option
                                                <span class="caret"></span></button>
                                                <ul class="dropdown-menu">
                                                    <li><a href="edit-livestock.php?id=<?php echo $data->lid; ?>"><i class="fa fa-edit"></i> Edit</a></li>
                                                    <li><a onclick="return confirm('Continue delete livestock ?')" href="delete.php?id=<?php echo $data->lid ?>"><i class="fa fa-trash"></i> Delete</a></li>
                                                    <li><a onclick="return confirm('Continue quarantine livestock ?')" href="quarantine.php?id=<?php echo $data->lid; ?>"><i class="fa fa-paper-plane"></i> Quarantine livestock</a></li>
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
                </div>
            </div>
        </div>


<?php include 'theme/foot.php'; ?>