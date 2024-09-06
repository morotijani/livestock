<?php include 'setting/system.php'; ?>
<?php include 'theme/head.php'; ?>
<?php include 'theme/sidebar.php'; ?>
<?php include 'session.php'; ?>

<!-- !PAGE CONTENT! -->
<div class="w3-main" style="margin-left:300px;margin-top:43px;">

  <!-- Header -->
  <header class="w3-container" style="padding-top:22px">
    <h5><b><i class="fa fa-dashboard"></i> Sales</b></h5>
  </header>
 
 <?php include 'inc/data.php'; ?>
 <div class="w3-container" style="padding-top:22px">
 <div class="w3-row">
 	<h2>Sales</h2>
 <div class="table-responsive">
 	<table class="table table-hover bg-success" id="table">
 		<thead>
 			<tr>
 				<th>S/N</th>
 				<th>livestock No.</th>
				<th>Type</th>
 				<th>Weight</th>
                <th>Sale Amount</th>
 				
 			</tr>
 		</thead>
 		<tbody>
 			<?php
               $qpi = $db->query("SELECT * FROM sales INNER JOIN livestock WHERE livestock.id = sales.livestock_id");
               $result = $qpi->fetchAll(PDO::FETCH_OBJ);
               $c = $qpi->rowCount();

               //selecting sales amount column only
               $sales = "SELECT amount FROM sales";
               $sales_rows=$db->query($sales)->fetchAll(PDO::FETCH_COLUMN);
               //calculating numbers/int values rows in sale amount column
               $total_sales= array_sum($sales_rows);

                $reorder_sales = "SELECT new_amount FROM reorder";
               $reorder_sales_rows=$db->query($reorder_sales)->fetchAll(PDO::FETCH_COLUMN);
               //calculating numbers/int values rows in sale amount column
               $reorder_total_sales = number_format(array_sum($reorder_sales_rows), 2);

               $total_sales = $total_sales + array_sum($reorder_sales_rows);
               $total_sales = number_format($total_sales, 2);

               $i = 1;
               foreach ($result as $j) {
               	 $livestockname = $j->livestockno;
				 $ls_type = $j->type;
               	 $b_id = $j->breed_id;
               	 $weight = $j->weight;
               	 $gender = $j->gender;
               	 $remark = $j->remark;
                 $sale_amount= $j->sale_amount;


               	 $k = $db->query("SELECT * FROM breed WHERE id = '$b_id' ");
               	 $ks = $k->fetchAll(PDO::FETCH_OBJ);
               	 foreach ($ks as $r) {
               	 	$bname = $r->name;
               	 ?>
                  <tr>
                  	<td>
                  		<?php echo $i; ?>

                  	</td>
                  	<td><?php echo $livestockname; ?></td>
					<td><?php echo $ls_type ?></td>                 	
                  	<td><?php echo $weight; ?></td>           
                    <td>
						<?php echo "GH₵". number_format($sale_amount, 2); ?>
                        <br>
                        <?= (($j->reorder == 1) ? '<span class="badge badge-warning">Re-order</span>' : ''); ?>
					</td>
                  	
                  </tr>
                 
               	 <?php
                 $i++; }
              }
 			?>
 		</tbody>
 	</table>
    <table>
            <tr>
 				<th></th>
 				<th></th>
				<th></th>
 				<th></th>
 				<th></th>
                <th></th>
 				<th></th>		
 			</tr>
            <tr>
                <td style="background-color: orange; height: 50px; padding: 10px; border-radius: 5px;">Discount Total Sales: GH₵<?= $reorder_total_sales;?> </td>
            </tr>
			<tr>
				<td style="background-color: grey; height: 50px; padding: 10px; border-radius: 5px;">Total Sales: GH₵<?= $total_sales;?> </td>
			</tr>
    </table>

 </div>
 </div>
</div>


</div>


<?php include 'theme/foot.php'; ?>