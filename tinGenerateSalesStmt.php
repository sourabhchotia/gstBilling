<?php 
require_once('include/config.php');if(!(isset($_SESSION['loginID'])))header("location:login.php");ob_start();
require('words.php');

$clientId = $_REQUEST['clt']; 
$startDate = $_REQUEST['sDt']; 
$endDate = $_REQUEST['eDt']; 

$selfDataQuery=$db->query("SELECT * FROM ".TABLE_CLIENT." WHERE client_id='".$clientId."'");
$selfDataQueryResult=$db->fetchNextObject($selfDataQuery);


$tbl_name=TABLE_TIN_SALES;
if($clientId=='')
{
	$query = "SELECT * FROM $tbl_name WHERE tin_sales_bill_date between '$startDate' and '$endDate' GROUP BY tin_sales_bill_number";
	$queryOut = "SELECT SUM(tin_sales_bill_total_amount) AS sum FROM $tbl_name WHERE tin_sales_bill_date < '$startDate'";
	$resultOut=$db->query($queryOut);
	$out = mysql_fetch_assoc($resultOut);
	if($out['sum']=='') $ttlBal = number_format(0, 2, '.', ''); else $ttlBal = number_format($out['sum'], 2, '.', '');
	
	$clt = "All";
}
else
{
	$query = "SELECT * FROM $tbl_name WHERE tin_sales_bill_party_id = $clientId and tin_sales_bill_date between '$startDate' and '$endDate' GROUP BY tin_sales_bill_number";
	$queryOut = "SELECT SUM(tin_sales_bill_total_amount) AS sum FROM $tbl_name WHERE tin_sales_bill_party_id = $clientId and tin_sales_bill_date < '$startDate'";
	$resultOut=$db->query($queryOut);
	$out = mysql_fetch_assoc($resultOut);
	if($out['sum']=='') $ttlBal = number_format(0, 2, '.', ''); else $ttlBal = number_format($out['sum'], 2, '.', '');
	
	$pageResult1=$db->query("SELECT * FROM ".TABLE_CLIENT." WHERE client_id=$clientId");
	$row1=$db->fetchNextObject($pageResult1);
	$clt = $row1->client_name;
}

$pageResult=$db->query($query);

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Sungold Enterprises</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="Charisma, a fully featured, responsive, HTML5, Bootstrap admin template.">
	<meta name="author" content="Muhammad Usman">
	<link id="bs-css" href="css/bootstrap-cerulean.css" rel="stylesheet">
	<style type="text/css">
	  body {
		padding-bottom: 40px;
	  }
	  .sidebar-nav {
		padding: 9px 0;
	  }
	</style>
	<link href="css/bootstrap-responsive.css" rel="stylesheet">
	<link href="css/charisma-app.css" rel="stylesheet">
	<link href="css/jquery-ui-1.8.21.custom.css" rel="stylesheet">
	<link href='css/fullcalendar.css' rel='stylesheet'>
	<link href='css/fullcalendar.print.css' rel='stylesheet'  media='print'>
	<link href='css/chosen.css' rel='stylesheet'>
	<link href='css/uniform.default.css' rel='stylesheet'>
	<link href='css/colorbox.css' rel='stylesheet'>
	<link href='css/jquery.cleditor.css' rel='stylesheet'>
	<link href='css/jquery.noty.css' rel='stylesheet'>
	<link href='css/noty_theme_default.css' rel='stylesheet'>
	<link href='css/elfinder.min.css' rel='stylesheet'>
	<link href='css/elfinder.theme.css' rel='stylesheet'>
	<link href='css/jquery.iphone.toggle.css' rel='stylesheet'>
	<link href='css/opa-icons.css' rel='stylesheet'>
	<link href='css/uploadify.css' rel='stylesheet'>
	<link rel="shortcut icon" href="img/logo1.png">

</head>
<body>
	
	<span style="float:right" class="icon32 icon-color icon-print" onClick="window.print();"></span>
	
	<br><br>
	
		<table height="100%" width="100%" frame="border">
		<tr>
			<td style="padding-left:1%; padding-right:1%">
			<!-- <div style="float:left">GSTIN :- <?php echo $selfDataQueryResult->client_tin; ?></div> -->
			<div style="float:right">PHONE :-(+91) 9829317670</div>
			</td>
		</tr>
		<tr>
			<td>
			<div align="center"><b><u>TAX INVOICE</u></b></div>
			</td>
		</tr>
		<tr>
			<td>
			<div align="center"><b><h1>SURAJ COURIER SERVICES</h1></b></div>
			</td>
		</tr>
		<tr>
			<td>
			<div align="center"><b><h4>C-19, Singh Bhoomi, Gayatri Marg, Khatipura</h4></b></div>
			</td>
		</tr>
		<tr>
			<td>
			<div align="center"><b><h4>Jaipur</h4></b></div><br>
			</td>
		</tr>
	</table>
	<table height="100%" width="100%" frame="border" border="1">
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
				$i=1;
				while($row=$db->fetchNextObject($pageResult))
				{
				   if($i==1)
				   {
				   ?>
					<tr align="right" style="font-weight:bold">
						<td align="center"><?php echo date("d-m-Y", strtotime($startDate)) ?></td>
						<td align="center"></td>
						<td align="center"></td>
						<td align="center">Opening Balance</td>
						<td align="center"></td>
						<td align="center"></td>
						<td style='padding-right:1%; padding-left:1%'><?php echo $ttlBal; ?></td>
					</tr>
				<?php
				   }
				   $i++;
				   
				   $bill = $row->tin_sales_bill_number;
							   
					$queryQuantity = "SELECT SUM(tin_sales_bill_quantity) AS sum FROM $tbl_name WHERE tin_sales_bill_number=$bill";
					$resultQuantity=$db->query($queryQuantity);
					$sum = mysql_fetch_assoc($resultQuantity);
					$quantity = $sum['sum'];
					
					$queryAmount = "SELECT SUM(tin_sales_bill_total_amount) AS sum FROM $tbl_name WHERE tin_sales_bill_number=$bill";
					$resultAmount=$db->query($queryAmount);
					$sum = mysql_fetch_assoc($resultAmount);
					$amount = $sum['sum']; 
						  
				   $ttlBal=number_format($ttlBal+$amount, 2, '.', '');
			  ?>
			  
				<tr>
					<td align="center"><?php echo date("d-m-Y", strtotime($row->tin_sales_bill_date)) ?></td>
					<td align="center"><?php echo $row->tin_sales_bill_party_name; ?></td>
					<td align="center"><?php echo $bill; ?></td>
					<td align="left" style='padding-right:1%; padding-left:1%'><?php echo $row->tin_sales_bill_description; ?></td>
					<td align="center"><?php echo $quantity;?></td>
					<td align="right" style='padding-right:1%;'><?php echo $amount; ?></td>
					<td align="right" style='padding-right:1%;'><?php echo $ttlBal; ?></td>
				</tr>
			
			<?php
			
				}
			?>                                           
			 <tr align="center">
			  <td colspan="8"><br></td>                                         
			 </tr>                           
		  </tbody>
	 </table> 
	
	<table height="100%" width="100%" frame="border" border="1">
		<tr>
			<td width="80%" valign="middle">
				<br><b><div align="center">Closing Balance &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div><br>
				<div align="left" style='padding-left:1%;'><?php if(ceil($ttlBal)<0) echo "Negative (-)"; echo Show_Amount_In_Words(abs(ceil($ttlBal)));?> Only </div>
				</b>
			</td>
			<td align="right" style='padding-right:1%;' valign="top">
				<br><b><div><?php echo number_format((float)(ceil($ttlBal)), 2, '.', ''); ?></div></b>
			</td>
		</tr>
	</table>
	
</body>
</html>