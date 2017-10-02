
<?php

if(isset($_REQUEST['search']))
{
	$billType=$_REQUEST['billType'];
	$startDate=date("Y-m-d", strtotime($_REQUEST['startDate']));
	$endDate=date("Y-m-d", strtotime($_REQUEST['endDate']));
		
	if($startDate=='1970-01-01')
	{
		$startDate=date("Y-m-d", strtotime('2016-04-01'));
		$endDate=date("Y-m-d");
	}
	
	if($billType=='Local')
	{
		$query = "SELECT * FROM tbl_direct_local_billing WHERE direct_local_bill_date between '$startDate' and '$endDate' GROUP BY direct_local_bill_number";
	}
	else
	{
		$query = "SELECT * FROM tbl_tin_sales WHERE tin_sales_bill_date between '$startDate' and '$endDate' GROUP BY tin_sales_bill_number";
	}
	
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
	var billType = document.getElementById('billType').value;
	var stDate = document.getElementById('startDate').value;
	var enDate = document.getElementById('endDate').value;
	
	if(billType=='')
	{
		alert("Select Bill Type !"); 
		return false;
	}
	else if (stDate=='' && enDate!='')
	{
		alert("Select Start Date & End Date Together !"); 
		return false;
	}
	else if (stDate!='' && enDate=='')
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
						<a href="#">Find Any Bill</a>
					</li>
				</ul>
			</div>
			
			<div>		
				<div class="box span12">
					<div class="box-header well" data-original-title>
					  <form class="form-horizontal" method="post" enctype="multipart/form-data" onsubmit="return validate();">
						<div style="float:left"><h2>Select Bill Type :- </h2> &nbsp;&nbsp;&nbsp; 
						  <select name="billType" id="billType" data-rel="chosen">
								<option value=''>Select Bill Type</option>
								<option value='Local'>Local</option>
								<option value='Sales'>Sales</option>
						  </select></div>
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
								  <th>Client Name</th>
								  <th>Bill Number</th>
								  <th>Quantity</th>
								  <th>Amount (Rs)</th>
								  <th>Action</th>
							  </tr>
						  </thead>
						  <tbody>
						 
							
						  <?php
						    $i=0;
							while($row=$db->fetchNextObject($pageResult))
							{
							   $i++;
							   
							   if($billType=='Local')
							   {
						  ?>
						  
							<tr>
							    <td><?php echo $i ?></td>
								<td><?php echo date("d-m-Y", strtotime($row->direct_local_bill_date)) ?></td>
								<td><?php echo $row->direct_local_bill_party_name; ?></td>
								<td><?php echo $bill = $row->direct_local_bill_number; ?></td>
								<td>
									<?php 
									  $queryQuantity = "SELECT SUM(direct_local_bill_quantity) AS sum FROM tbl_direct_local_billing WHERE direct_local_bill_number=$bill";
									  $resultQuantity=$db->query($queryQuantity);
									  $sum = mysql_fetch_assoc($resultQuantity);
									  echo $sum['sum']; 
									?>
								</td>
								<td>
									<?php 
									  $queryAmt = "SELECT SUM(direct_local_bill_total_amount) AS sum FROM tbl_direct_local_billing WHERE direct_local_bill_number=$bill";
									  $resultAmt=$db->query($queryAmt);
									  $sum = mysql_fetch_assoc($resultAmt);
									  echo $sum['sum']; 
									?>
								</td>
								<td>
									<a class="btn btn-success" href="index.php?c=lDe&bn=<?php echo $bill; ?>&tp=<?php echo $billType; ?>">
										<i class="icon-zoom-in icon-white"></i>  
										View Bill                                          
									</a>
								</td>
							</tr>
						
						<?php
						 		}
								else
								{
								
						?>
						
							<tr>
							    <td><?php echo $i ?></td>
								<td><?php echo date("d-m-Y", strtotime($row->tin_sales_bill_date)) ?></td>
								<td><?php echo $row->tin_sales_bill_party_name; ?></td>
								<td><?php echo $bill = $row->tin_sales_bill_number; ?></td>
								<td><?php 
									$queryQuantity = "SELECT SUM(tin_sales_bill_quantity) AS sum FROM tbl_tin_sales WHERE tin_sales_bill_number=$bill";
									$resultQuantity=$db->query($queryQuantity);
									$sum = mysql_fetch_assoc($resultQuantity);
									echo $quantity = $sum['sum']; 
								?></td>
								<td align="right"><?php 
								$queryAmount = "SELECT SUM(tin_sales_bill_total_amount) AS sum FROM tbl_tin_sales WHERE tin_sales_bill_number=$bill";
								$resultAmount=$db->query($queryAmount);
								$sum = mysql_fetch_assoc($resultAmount);
								echo $amount = $sum['sum'];
								?></td>
								<td>
									<a class="btn btn-success" href="index.php?c=lDe&bn=<?php echo $bill; ?>&tp=<?php echo $billType; ?>&cid=<?php echo $row->tin_sales_bill_party_id; ?>">
										<i class="icon-zoom-in icon-white"></i>  
										View Bill                                          
									</a>
								</td>
							</tr>
						
						
						<?php
								}
							}
						?>
							  
						  </tbody>
						</table>       
					</div>
				</div><!--/span-->
			
			</div><!--/row-->