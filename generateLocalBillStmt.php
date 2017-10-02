<?php 
require_once('include/config.php');if(!(isset($_SESSION['loginID'])))header("location:login.php");ob_start();
require('words.php');

$startDate = $_REQUEST['sDt']; 
$endDate = $_REQUEST['eDt']; 

$selfDataQuery=$db->query("SELECT * FROM ".TABLE_CLIENT." WHERE client_role='SELF'");
$selfDataQueryResult=$db->fetchNextObject($selfDataQuery);


$tbl_name=TABLE_DIRECT_LOCAL_BILLING;
$query = "SELECT * FROM $tbl_name WHERE direct_local_bill_date between '$startDate' and '$endDate' GROUP BY direct_local_bill_number";
$queryOut = "SELECT SUM(direct_local_bill_total_amount) AS sum FROM $tbl_name WHERE direct_local_bill_date < '$startDate'";
$resultOut=$db->query($queryOut);
$out = mysql_fetch_assoc($resultOut);
if($out['sum']=='') $ttlBal = number_format(0, 2, '.', ''); else $ttlBal = number_format($out['sum'], 2, '.', '');

$clt = "All";

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
			<div style="float:left">TIN :- <?php echo $selfDataQueryResult->client_tin; ?></div>
			<div style="float:right">PHONE :- <?php echo $selfDataQueryResult->client_mobile; ?></div>
			</td>
		</tr>
		<tr>
			<td>
			<br><div align="center"><b><font size="+2"><?php echo $selfDataQueryResult->client_firm_name; ?></font></b></div>
			</td>
		</tr>
		<tr>
			<td>
			<div align="center"><?php echo $selfDataQueryResult->client_address; ?></div>
			</td>
		</tr>
		<tr>
			<td>
			<div align="center"><b><font size="+1">Local Bill Statements</font></b></div>
			</td>
		<tr>
		</tr>
			<td>
			<div align="center"><font size="+1">From (<?php echo date("d-m-Y", strtotime($startDate))." To ".date("d-m-Y", strtotime($endDate)) ?>)</font></div>
			</td>
		</tr>
		<tr>
			<td>
			<div align="center"><b><font size="+1">Account : <?php echo $clt; ?> </font></b></div>
			</td>
		</tr>
	</table>
	
	<table height="100%" width="100%" frame="border" border="1">
		  <thead>
			  <tr>
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
				   if($i==1)
				   {
				   ?>
					<tr align="right" style="font-weight:bold">
						<td align="center"><?php echo date("d-m-Y", strtotime($startDate)) ?></td>
						<td align="center">Opening Balance</td>
						<td align="center"></td>
						<td align="center"></td>
						<td align="center"></td>
						<td style='padding-right:1%; padding-left:1%'></td>
						<td style='padding-right:1%; padding-left:1%'><?php echo $ttlBal; ?></td>
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
					<td align="center"><?php echo date("d-m-Y", strtotime($row->direct_local_bill_date)) ?></td>
					<td align="center"><?php echo $row->direct_local_bill_party_name; ?></td>
					<td align="center"><?php echo $row->direct_local_bill_party_phone; ?></td>
					<td align="center"><?php echo $bill; ?></td>
					<td align="center"><?php echo $quantity; ?></td>
					<td align="right" style='padding-right:1%;'><?php echo $amount;  ?></td>
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