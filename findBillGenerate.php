<?php 
require_once('include/config.php');if(!(isset($_SESSION['loginID'])))header("location:login.php");ob_start();
require('words.php');
 
$selfDataQuery=$db->query("SELECT * FROM ".TABLE_CLIENT." WHERE client_role='SELF'");
$selfDataQueryResult=$db->fetchNextObject($selfDataQuery); 
									
$billType=$_REQUEST['tp'];
$billNumber=$_REQUEST['bn'];
$clientId=$_REQUEST['cid'];

if($billType=='Sales')
{
	$table = TABLE_TIN_SALES;
	$cat = 'tin_sales';
}
else if($billType=='Purchase')
{
	$table = TABLE_TIN_PURCHASE;
	$cat = 'tin_purchase';
}
else if($billType=='SR')
{
	$table = TABLE_TIN_SR;
	$cat = 'tin_sr';
}
else if($billType=='PR')
{
	$table = TABLE_TIN_PR;
	$cat = 'tin_pr';
}
else if($billType=='Local')
{
	$table = TABLE_DIRECT_LOCAL_BILLING;
	$cat = 'direct_local';
}


if($clientId==0)
{
	$clientDataQuery=$db->query("SELECT * FROM $table WHERE ".$cat."_bill_number=$billNumber");
	$clientDataQueryResult=$db->fetchNextObject($clientDataQuery);
	$clientName = $clientDataQueryResult->direct_local_bill_party_name;
	$clientAddress = '';
	$clientPhone = $clientDataQueryResult->	direct_local_bill_party_phone;
	$clientType = '';
	$clientTin = '';
}
else
{
	$clientDataQuery=$db->query("SELECT * FROM ".TABLE_CLIENT." WHERE client_id=$clientId");
	$clientDataQueryResult=$db->fetchNextObject($clientDataQuery);
	$clientName = $clientDataQueryResult->client_firm_name;
	$clientAddress = $clientDataQueryResult->client_address;
	$clientPhone = $clientDataQueryResult->client_mobile;
	$clientType = $clientDataQueryResult->client_role;
	$clientTin = $clientDataQueryResult->client_tin;
}


$pageResult1=$db->query("SELECT * FROM $table WHERE ".$cat."_bill_number=$billNumber");
$ans=$db->fetchNextObject($pageResult1);
$c=$cat."_bill_date";
$billDate = $ans->$c;

$pageResult=$db->query("SELECT * FROM $table WHERE ".$cat."_bill_number=$billNumber");

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
			<div align="center"><b><u>DUPLICATE INVOICE (<?php echo $billType; ?>)</u></b></div>
			</td>
		</tr>
		<tr>
			<td>
			<div align="center"><b><h3><?php echo $selfDataQueryResult->client_firm_name; ?></h3></b></div>
			</td>
		</tr>
		<tr>
			<td>
			<div align="center"><b><h5>	<?php echo $selfDataQueryResult->client_address; ?></h5></b></div><br>
			</td>
		</tr>
	</table>
	
	<table height="100%" width="100%" frame="border" border="1">
		<tr>
			<td style="padding-left:1%; padding-right:1%">
			<b><u>Party Detail :-</u></b> <br><br>
			Name &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; :- &nbsp;&nbsp;&nbsp;<b><?php echo $clientName; ?></b><br>
			Address &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:- &nbsp;&nbsp;&nbsp;<?php echo $clientAddress; ?><br>
			Contact No &nbsp;:- &nbsp;&nbsp;&nbsp;<?php echo $clientPhone; ?><br>
			Party Type &nbsp;&nbsp;:- &nbsp;&nbsp;&nbsp;<?php echo $clientType; ?><br>
			Party Tin &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:- &nbsp;&nbsp;&nbsp;<?php echo $clientTin;?><br><br>
			</td>
			
			<td style="padding-left:1%; padding-right:1%;" valign="top">
			<br>
			Receipt No &nbsp;&nbsp;&nbsp;&nbsp; :- &nbsp;&nbsp;&nbsp;<b><?php echo $billNumber;?> </b><br>
			Receipt Date&nbsp; :- &nbsp;&nbsp;&nbsp;<?php echo date("d-m-Y", strtotime($billDate));?><br>
			</td>
		</tr>
	</table>
	
	<table height="100%" width="100%" frame="border" border="1">
		  <thead>
			  <tr>
				  <th>S.N.</th>
				  <th align="left">Description Of Goods</th>
				  <th>Quantity</th>
				  <th>Unit Price</th>
				  <th>Total Price</th>
				  <th>Vat %</th>
				  <th>Vat Amount</th>
				  <th>Amount (Rs.)</th>                                          
			  </tr>
		  </thead>   
		  <tbody>
			 <?php
			 	$i=1; $total=0; $pcs=0; $totalPrice=0; $vat=0; $vatAmt=0;
				
				while($row=$db->fetchNextObject($pageResult))
				{
	             ?>
										<tr align="right">
											<td style="padding-right:1%" class="center" name="sn" id="sn"><?php echo $i ?></td>
											<td style="padding-right:1%" class="center" name="desc" id="desc"><?php $a = $cat."_bill_description"; echo $row->$a; ?></td>
											<td style="padding-right:1%" class="center" name="quantity" id="quantity"><?php $a = $cat."_bill_quantity"; echo $row->$a; $pcs+=$row->$a;?></td>
											<td style="padding-right:1%" class="center" name="unitPrice" id="unitPrice"><?php $a = $cat."_bill_unit_price"; echo $row->$a; ?></td>
											<td style="padding-right:1%" class="center" name="totalPrice" id="totalPrice"><?php if($billType!='Local') { $a = $cat."_bill_total_price"; echo $row->$a; $totalPrice+=$row->$a; }?></td>
											<td style="padding-right:1%" class="center" name="vatPer" id="vatPer"><?php if($billType!='Local') { $a = $cat."_bill_vat"; echo $row->$a; $vat=$row->$a; }?></td>
											<td style="padding-right:1%" class="center" name="vatAmt" id="vatAmt"><?php if($billType!='Local') { $a = $cat."_bill_vat_amount"; echo $row->$a; $vatAmt+=$row->$a; }?></td>
											<td style="padding-right:1%" class="center" name="ttlAmount" id="ttlAmount"><?php $a = $cat."_bill_total_amount"; echo $row->$a; $total+=$row->$a; ?></td>
										</tr>
										<?php
										$i++;
									} 
							 ?>                             
			 <tr align="center">
			  <td><br></td>
			  <td align="left"><br></td>
			  <td><br><br><br></td>
			  <td><br><br><br></td>
			  <td><br><br><br></td>
			  <td><br><br><br></td>
			  <td><br><br><br></td>
			  <td><br><br><br></td>                                          
			 </tr>                           
		  </tbody>
	 </table> 
	
	 <table height="100%" width="100%" frame="border" border="1">
		<tr>
			<td width="80%">
				<div align="right">Total &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>
				<div align="center">Add : Round Off (+)</div><br>
			</td>
			
			<td align="right" style='padding-right:1%'>
			<?php $totalAmt = number_format((float)$total, 2, '.', ''); echo $totalAmt; ?><br>
			<?php echo number_format((float)(ceil($totalAmt)-$totalAmt), 2, '.', ''); ?><br>
			</td>
		</tr>
	</table>
	
	<table height="100%" width="100%" frame="border" border="1">
		<tr>
			<td width="80%">
				<b><div align="center">Grand Total &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <?php echo $pcs;?> Pcs. </div></b>
			</td>
			<td align="right" style='padding-right:1%'>
				<b><div><?php echo number_format((float)(ceil($totalAmt)), 2, '.', ''); ?></div></b>
			</td>
		</tr>
	</table>
	
	<table height="100%" width="100%" frame="border">
		<tr>
			<td width="80%" style="padding-left:1%; padding-right:1%">
				<b><br><br><div align="left"><?php echo "Sale @$vat% = ".number_format((float)$totalPrice, 2, '.', '')." , VAT=".number_format((float)$vatAmt, 2, '.', '');?></div><br><br>
				<div align="left"><?php echo Show_Amount_In_Words(ceil($totalAmt));?> Only</div></b><br>
			</td>
		</tr>
	</table>
	
	<table height="100%" width="100%" frame="border" border="1">
		<tr>
			<td style="padding-left:1%; padding-right:1%" valign="top">
			<br><b><u>Terms & Conditions :-</u></b> <br><br>
			E. & O.E.<br>
			1) Goods once sold will not be taken back .<br>
			2) Interest @ 18% p.a. will be charged if payment is not made within the stipulated time . <br>
			3) Subject to JAIPUR jurisdiction only . <br>
			</td>
			
			<td style="padding-left:1%; padding-right:1%">
			<br><div align="left" style="border-bottom:dashed"><b>Receiver's Signature : </b><br><br></div>  
			<div align="right"><h3>For <?php echo $selfDataQueryResult->client_firm_name; ?></h3></div><br><br><br>
			<div align="right"><h3>Authorised Signatory</h3></div><br>
			</td>
		</tr>
	</table>
	
</body>