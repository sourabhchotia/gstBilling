<?php 
require_once('include/config.php');if(!(isset($_SESSION['loginID'])))header("location:login.php");ob_start();
require('words.php');
 
$selfDataQuery=$db->query("SELECT * FROM ".TABLE_CLIENT." WHERE client_role='SELF'");
$selfDataQueryResult=$db->fetchNextObject($selfDataQuery); 
									

$clientName = $_POST['clientName'];
$clientPhone = $_POST['clientPhone'];
$billDate = $_POST['billdate'];



$lastBillDataQuery=$db->query("SELECT * FROM ".TABLE_DIRECT_LOCAL_BILLING." ORDER BY direct_local_bill_number desc LIMIT 1");
$lastBillDataQueryResult=$db->fetchNextObject($lastBillDataQuery);
$billNumber = $lastBillDataQueryResult->direct_local_bill_number+1;


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
			<div style="float:left"> || श्री महावीराय नमः ||</div>
			<div style="float:right">|| श्री महावीराय नमः ||</div>
			</td>
		</tr>
		<tr>
			<td>
			<div align="center"><b><u>CASH MEMO</u></b></div>
			</td>
		</tr>
		<tr>
			<td>
			<div align="center"><b><h3>Sungold Mobile</h3></b></div>
			</td>
		</tr>
		<tr>
			<td>
			<div align="center"><b><h5>	K.P. Road , Vaishali Nagar Jaipur .</h5></b></div><br>
			</td>
		</tr>
	</table>
	
	<table height="100%" width="100%" frame="border" border="1">
		<tr>
			<td style="padding-left:1%; padding-right:1%">
			<b><u>Party Detail :-</u></b> <br><br>
			Name &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; :- &nbsp;&nbsp;&nbsp;<b><?php echo $clientName; ?></b><br>
			Contact No &nbsp;:- &nbsp;&nbsp;&nbsp;<?php echo $clientPhone; ?><br>
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
				  <th>Description Of Goods</th>
				  <th>Quantity</th>
				  <th>Unit Price</th>
				  <th>Total Amount (Rs.)</th>                                           
			  </tr>
		  </thead>   
		  <tbody>
			 <?php
			 	$pcs=0; $totalPrice=0;
				
				foreach ($_POST['cashData'] as $value) 
				{
					if($value!='')
					{
					    echo "<tr align='right'>";
						$data1 = explode(",",$value);
						foreach ($data1 as $key => $data) 
						{
							if($key==1)
							{
								$desc = explode("\n",$data);
								echo "<td align='left' style='padding-left:1%;'>";
								foreach ($desc as $detail) 
								{
									echo "$detail<br>";
								}
								echo "</td>";
							}
							else
							{
								echo "<td style='padding-right:1%'>$data</td>";
							}
							
							if($key==2)
							{
								$pcs = $pcs+$data;
							}
							
							if($key==4)
							{
								$totalPrice = $totalPrice+$data;
							}
						}
						echo "</tr>";
					}
				}
			?>                                            
			 <tr align="center">
			  <td><br></td>
			  <td align="left"><br></td>
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
			<?php $totalAmt = number_format((float)$totalPrice, 2, '.', ''); echo $totalAmt; ?><br>
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
				<b><br><br>
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
			<div align="right"><h3>For Sungold Mobile</h3></div><br><br><br>
			<div align="right"><h3>Authorised Signatory</h3></div><br>
			</td>
		</tr>
	</table>
	
</body>
</html>

<?php
							
foreach ($_POST['cashData'] as $value) 
{
	if($value!='')
	{
		$data = explode(",",$value);
		$db->query("INSERT INTO ".TABLE_DIRECT_LOCAL_BILLING." SET 
								direct_local_bill_number=$billNumber,
								direct_local_bill_description='$data[1]',
								direct_local_bill_quantity=$data[2],
								direct_local_bill_unit_price=$data[3],
								direct_local_bill_total_amount=$data[4],
								direct_local_bill_party_phone=$clientPhone,
								direct_local_bill_party_name='$clientName',
								direct_local_bill_date='".date("Y-m-d", strtotime($billDate))."'");
	}
}

?>