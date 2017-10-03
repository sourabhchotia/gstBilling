<?php 
require_once('include/config.php');if(!(isset($_SESSION['loginID'])))header("location:login.php");ob_start();
require('words.php');
 
									
$clientId = $_POST['client'];
$billDate = $_POST['billdate'];

$selfDataQuery=$db->query("SELECT * FROM ".TABLE_CLIENT." WHERE client_id=$clientId");
$selfDataQueryResult=$db->fetchNextObject($selfDataQuery); 
if($clientId==0)
{
	$clientName = $_POST['clientName'];
	$clientAddress = $_POST['clientAddress'];
	$clientPhone = $_POST['clientPhone'];
	$clientType = '';
	// $clientTin = '';
}
else
{
	$clientDataQuery=$db->query("SELECT * FROM ".TABLE_CLIENT." WHERE client_id=$clientId");
	$clientDataQueryResult=$db->fetchNextObject($clientDataQuery);
	$clientName = $clientDataQueryResult->client_name;
	$clientAddress = $clientDataQueryResult->client_address;
	$clientPhone = $clientDataQueryResult->client_mobile;
	$clientEmail = $clientDataQueryResult->client_email;
	// $clientTin = $clientDataQueryResult->client_tin;
}
 



$lastBillDataQuery=$db->query("SELECT * FROM ".TABLE_PACKET." ORDER BY billno desc");
$lastBillDataQueryResult=$db->fetchNextObject($lastBillDataQuery);
$billNumber = $lastBillDataQueryResult->billno+1;

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

	<script type="text/javascript">

		 // $(document).click(function(e){
   //      if ($(e.target).is('#fuel,#fuel *')) {
   //          return;
   //      }
   //      else
   //      {
   //          alert("Hi");
            
   //      }
   //  });
		function grand(){
				var total = parseInt(document.getElementById("total").innerHTML);
				var fuelSurcharge = parseInt(document.getElementById("fuel").value);

				var gTotal = total + fuelSurcharge;
				document.getElementById("gtotal").innerHTML = parseFloat(gTotal).toFixed(2);

			return true;
		}
	</script>

</head>
<body>
	
	<span style="float:right" class="icon32 icon-color icon-print" onClick="window.print();"></span>
	
	<br><br>
	
	<table height="100%" width="100%" frame="border">
		<tr>
			<td style="padding-left:1%; padding-right:1%">
			<!-- <div style="float:left">GSTIN :- <?php echo $selfDataQueryResult->client_tin; ?></div> -->
			<div style="float:right">PHONE :- <?php echo $selfDataQueryResult->client_mobile; ?></div>
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
		<tr>
			<td style="padding-left:1%; padding-right:1%">
			<b><u>Party Detail :-</u></b> <br><br>
			Name &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; :- &nbsp;&nbsp;&nbsp;<b><?php echo $clientName; ?></b><br>
			Address &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:- &nbsp;&nbsp;&nbsp;<?php echo $clientAddress; ?><br>
			Contact No &nbsp;:- &nbsp;&nbsp;&nbsp;<?php echo $clientPhone; ?><br>
			Party Type &nbsp;&nbsp;:- &nbsp;&nbsp;&nbsp;<?php echo $clientEmail; ?><br>
			<!-- Party GSTin &nbsp;&nbsp;&nbsp;:- &nbsp;&nbsp;&nbsp;<?php echo $clientTin;?><br><br> -->
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
			 	$total=0; $date=0; $item=0; $weight=0; $rate=0; $from=0; $to=0;
				
				foreach ($_POST['salesData'] as $value) 
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
								$date = $data;
							}
							
							if($key==3)
							{
								$item = $data;
							}
							
							if($key==4)
							{
								$weight = $weight;
							}
							
							if($key==5)
							{
								$rate = $data;
							}
							
							if($key==6)
							{
								$from = $data;
							}
							
							if($key==7)
							{
								$to = $data;
							}
							
							if($key==8)
							{
								$total = $total+$data;
							}
						}
						echo "</tr>";
					}
				}
			?>                                            
			<!--  <tr align="center">
			  <td><br></td>
			  <td align="left"><br></td>
			  <td><br><br><br></td>
			  <td><br><br><br></td>
			  <td><br><br><br></td>
			  <td><br><br><br></td>
			  <td><br><br><br></td>
			  <td><br><br><br></td>
			  <td><br><br><br></td>
			  <td><br><br><br></td>                                          
			 </tr>  -->                          
		  </tbody>
	 </table> 
	
	 <table height="100%" width="100%" frame="border" border="1">
		<tr>
			<td width="80%">
				<div align="right">Total &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>
				<div align="right">Fuel Surcharge</div><br>
			</td>
			
			<td align="right" style='padding-right:1%'>
				<table>
			<tr><td id="total" value="<?php echo $totalAmt; ?>"> <?php $totalAmt = number_format((float)$total, 2, '.', ''); echo $totalAmt; ?></td></tr>
			<tr><td><input type="text" id="fuel" name="fuel" onfocusout="grand();" style="border: none; width: 50px;"></td></tr></table>
			</td>
		</tr>
	</table>
	<table height="100%" width="100%" frame="border" border="1">
		<tr>
			<td width="80%">
				<b><div align="right">Grand Total</div></b>
			</td>
			<td align="right" style='padding-right:1%'>
				<b><div id="gtotal" value = "<?php echo $totalAmt; ?>"><?php echo $totalAmt; ?></div></b>
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
			<br><div align="left" style="border-bottom:dashed"><b>Receiver's Signature : </b><br></div>  
			<div align="right"><h4>For <?php echo $selfDataQueryResult->client_name; ?></h4></div><br>
			<div align="right"><h4>Authorised Signatory</h4></div><br>
			</td>
		</tr>
	</table>
	
</body>
</html> 

<?php
								
								
foreach ($_POST['salesData'] as $value) 
{
	if($value!='')
	{
		$data = explode(",",$value);
		$db->query("INSERT INTO ".TABLE_PACKET." SET 
					billno = $billNumber,
					cno ='$data[1]',
					bill_date = '".date("Y-m-d", strtotime($billDate))."',
					item = '$data[3]',
					weight = '$data[4]',
					rate = '$data[5] ',
					from_city = '$data[6]',
					destination = '$data[7]',
					amount = '$data[8]'"
				);
	}
}
?>