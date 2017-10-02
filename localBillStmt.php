
<?php

$flag=0;
if(isset($_REQUEST['search']))
{
	$tbl_name=TABLE_DIRECT_LOCAL_BILLING;		//your table name
	$startDate=date("Y-m-d", strtotime($_REQUEST['startDate']));
	$endDate=date("Y-m-d", strtotime($_REQUEST['endDate']));
	
	
	$query = "SELECT * FROM $tbl_name WHERE direct_local_bill_date between '$startDate' and '$endDate' GROUP BY direct_local_bill_number";
	
	$queryOut = "SELECT SUM(direct_local_bill_total_amount) AS sum FROM $tbl_name WHERE direct_local_bill_date < '$startDate'";
	
	$resultOut=$db->query($queryOut);
	$out = mysql_fetch_assoc($resultOut);
	if($out['sum']=='') $ttlBal = number_format(0, 2, '.', ''); else $ttlBal = number_format($out['sum'], 2, '.', '');
	
	$pageResult=$db->query($query);
}
else
{
	$pageResult='';
}


		
?>

<script>
function validate() 
{
	var stDate = document.getElementById('startDate').value;
	var enDate = document.getElementById('endDate').value;
	
	if (stDate=='' || enDate=='')
	{
		alert("Select Start Date & End Date Together !"); 
		return false;
	}
	else if (stDate>enDate)
	{
		alert("End Date Can't before Start Date !"); 
		return false;
	}
	else
	{
		return true;
	}
	
}
</script>


			<div>
				<ul class="breadcrumb">
					<li>
						<a href="#">Home</a> <span class="divider">/</span>
					</li>
					<li>
						<a href="#">Local Bill Statements</a>
					</li>
				</ul>
			</div>
			
			<div>		
				<div class="box span12">
					<div class="box-header well" data-original-title>
					  <form class="form-horizontal" method="post" enctype="multipart/form-data" onsubmit="return validate();">
						<div style="float:left"><h2>Select Date :- </h2> </div>
						  <div style="float:left"><h2> &nbsp;&nbsp;&nbsp; From:- &nbsp;&nbsp;&nbsp;</h2><input type="text" class="datepicker" name="startDate" id="startDate"></div>
						  <div style="float:left"><h2> &nbsp;&nbsp;&nbsp; To:- &nbsp;&nbsp;&nbsp; </h2><input type="text" class="datepicker" name="endDate" id="endDate"></div>
						  <div style="float:left">&nbsp;&nbsp;&nbsp;<button type="submit" name="search" class="btn btn-primary">Search</button></div>
						</form>
					</div>
					<div class="box-content">
						<table class="table table-striped table-bordered bootstrap-datatable datatable">
						  <thead>
							  <tr>
							      <th>S.N.</th>
								  <th>Date</th>
								  <th>Name</th>
								  <th>Contact Number</th>
								  <th>Bill Number</th>
								  <th>Quantity</th>
								  <th>Amount (Rs)</th>
								  <th>Total Amount (Rs)</th>
							  </tr>
						  </thead>
						  <tbody>
						 
							
						  <?php
						    $i=1;
							while($row=$db->fetchNextObject($pageResult))
							{
							   $flag=1;
							   if($i==1)
							   {
							   ?>
							   	<tr align="right">
								    <td><?php echo $i ?></td>
									<td><?php echo date("d-m-Y", strtotime($startDate)) ?></td>
									<td>Opening Balance</td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td><?php echo $ttlBal; ?></td>
								</tr>
							<?php
							   }
							   $i++;
							   
							   $bill = $row->direct_local_bill_number;
							   
								$queryQuantity = "SELECT SUM(direct_local_bill_quantity) AS sum FROM $tbl_name WHERE direct_local_bill_number=$bill";
								$resultQuantity=$db->query($queryQuantity);
								$sum = mysql_fetch_assoc($resultQuantity);
								$quantity = $sum['sum'];
								
								$queryAmount = "SELECT SUM(direct_local_bill_total_amount) AS sum FROM $tbl_name WHERE direct_local_bill_number=$bill";
								$resultAmount=$db->query($queryAmount);
								$sum = mysql_fetch_assoc($resultAmount);
								$amount = $sum['sum']; 
									  
							   $ttlBal=number_format($ttlBal+$amount, 2, '.', '');
						  ?>
						  
							<tr>
							    <td><?php echo $i ?></td>
								<td><?php echo date("d-m-Y", strtotime($row->direct_local_bill_date)) ?></td>
								<td><?php echo $row->direct_local_bill_party_name; ?></td>
								<td><?php echo $row->direct_local_bill_party_phone; ?></td>
								<td><?php echo $bill; ?></td>
								<td><?php echo $quantity; ?></td>
								<td align="right"><?php echo $amount;  ?></td>
								<td align="right"><?php echo $ttlBal; ?></td>
							</tr>
						
						<?php
							}
						?>
							  
						  </tbody>
						</table>
						<?php if($flag==1) {?>  
					  
					  <table class="table">
					  	<tr>
							<td colspan="9">
								<div align="center">
									<a href="<?php echo FILE_GEN_LOCAL_BILL_STATEMENT."?sDt=$startDate&eDt=$endDate" ?>" target="_blank"><button type="submit" class="btn btn-primary">Print Statement</button></a>
	
								</div>
							</td>                                  
						</tr>
					  </table> 
					  <?php } ?>           
					</div>
				</div><!--/span-->
			
			</div><!--/row-->