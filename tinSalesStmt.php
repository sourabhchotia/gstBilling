
<?php
$tbl_name=TABLE_PACKET;		//your table name

$flag=0;
if(isset($_REQUEST['search']))
{
	$clientId=$_REQUEST['client'];
	$startDate=date("Y-m-d", strtotime($_REQUEST['startDate']));
	$endDate=date("Y-m-d", strtotime($_REQUEST['endDate']));
	
	if($clientId=='')
	{
		$query = "SELECT * FROM $tbl_name WHERE bill_date between '$startDate' and '$endDate' GROUP BY billno";
		$queryOut = "SELECT SUM(amount) AS sum FROM $tbl_name WHERE bill_date < '$startDate'";
		$resultOut=$db->query($queryOut);
		$out = mysql_fetch_assoc($resultOut);
		if($out['sum']=='') $ttlBal = number_format(0, 2, '.', ''); else $ttlBal = number_format($out['sum'], 2, '.', '');
	}
	else if($clientId!='' && $startDate=='1970-01-01')
	{
		$query = "SELECT * FROM $tbl_name WHERE party_id = $clientId GROUP BY billno";
		$startDate=date("Y-m-d", strtotime('2016-04-01'));
		$endDate=date("Y-m-d");
		$ttlBal = number_format(0, 2, '.', '');
	}
	else
	{
		$query = "SELECT * FROM $tbl_name WHERE party_id = $clientId and bill_date between '$startDate' and '$endDate'";
		$queryOut = "SELECT SUM(amount) AS sum FROM $tbl_name WHERE party_id = $clientId and bill_date < '$startDate'";
		$resultOut=$db->query($queryOut);
		$out = mysql_fetch_assoc($resultOut);
		if($out['sum']=='') $ttlBal = number_format(0, 2, '.', ''); else $ttlBal = number_format($out['sum'], 2, '.', '');
	}
	
	$pageResult=$db->query($query);
}
else
{
	$query = "SELECT * FROM $tbl_name";
	$queryOut = "SELECT SUM(amount) AS sum FROM $tbl_name";
	$resultOut=$db->query($queryOut);
	$out = mysql_fetch_assoc($resultOut);
	if($out['sum']=='') $ttlBal = number_format(0, 2, '.', ''); else $ttlBal = number_format($out['sum'], 2, '.', '');

	$pageResult=$db->query($query);
}


		
?>

<script>
function validate() 
{
	var clnt = document.getElementById('client').value;
	var stDate = document.getElementById('startDate').value;
	var enDate = document.getElementById('endDate').value;
	
	if(clnt=='' && stDate=='' && enDate=='')
	{
		alert("Select any One Filter Criteria !"); 
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
						<a href="#">Sales Statements</a>
					</li>
				</ul>
			</div>
			
			<div>		
				<div class="box span12">
					<div class="box-header well" data-original-title>
					  <form class="form-horizontal" method="post" enctype="multipart/form-data" onsubmit="return validate();">
						<div style="float:left"><h2>Select Party :- </h2> &nbsp;&nbsp;&nbsp; 
							<select name="client" id="client">
							<?php 
								
								echo "<option value=''>---None---</option>";
								$pageResult1=$db->query("SELECT * FROM ".TABLE_CLIENT." WHERE client_status='A'");
								while($resultRow=$db->fetchNextObject($pageResult1))
								{
									echo "<option value='$resultRow->client_id'>$resultRow->client_name</option>";
								}
							?>
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
								  <th>Consignment No.</th>
								  <th>Date</th>
								  <th>Item</th>
								  <th>Weight in kg</th>
								  <th>Rate</th>
								  <th>From</th>
								  <th>Destination</th> 
								  <th>Amount</th>                                        
							  </tr>                                          
						  </thead>
						  <tbody>
						 
							
						  <?php
						  // 		$sql = "SELECT * FROM tbl_packet";
								// $queryOut = "SELECT SUM(amount) AS sum FROM tbl_packet";
								// $result = $db->query($sql);
								// $out = mysql_fetch_assoc($result);
						    $i=0;
							while($row=$db->fetchNextObject($pageResult))
							{
							   $flag=1;
							   if($i==1)
							   {
							   ?>
							   <!-- 	<tr align="right">
								    <td><?php echo $i ?></td>
									<td><?php echo date("d-m-Y", strtotime($startDate)) ?></td>
									<td></td>
									<td></td>
									<td>Opening Balance</td>
									<td></td>
									<td></td>
									<td><?php echo $ttlBal; ?></td>
								</tr> -->
							<?php
							   }
							   $i++;
								$bill = $row->billno;
							   
								// $queryQuantity = "SELECT SUM(tin_sales_bill_quantity) AS sum FROM $tbl_name WHERE tin_sales_bill_number=$bill";
								// $resultQuantity=$db->query($queryQuantity);
								// $sum = mysql_fetch_assoc($resultQuantity);
								// $quantity = $sum['sum'];
								
								$queryAmount = "SELECT SUM(amount) AS sum FROM $tbl_name WHERE billno=$bill";
								$resultAmount=$db->query($queryAmount);
								$sum = mysql_fetch_assoc($resultAmount);
								$amount = $sum['sum']; 
									  
							   $ttlBal=number_format($ttlBal+$amount, 2, '.', '');
						  ?>
						  
							<tr>
							    <td><?php echo $i ?></td>
							    <td><?php echo $row->cno ?></td>
								<td><?php echo date("d-m-Y", strtotime($row->bill_date)) ?></td>
								<td><?php echo $row->item; ?></td>
								<!-- <td><?php echo $bill; ?></td> -->
								<td><?php echo $row->weight; ?></td>
								<td><?php echo $row->rate; ?></td>
								<td><?php echo $row->from_city; ?></td>
								<td><?php echo $row->destination; ?></td>
								<td><?php echo $amount; ?></td>
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
									<a href="<?php echo FILE_GEN_SALES_STATEMENT."?clt=$clientId&sDt=$startDate&eDt=$endDate" ?>" target="_blank"><button type="submit" class="btn btn-primary">Print Statement</button></a>
	
								</div>
							</td>                                  
						</tr>
					  </table> 
					  <?php } ?>           
					</div>
				</div><!--/span-->
			
			</div><!--/row-->