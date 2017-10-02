<script language="javascript" type="text/javascript">
$(function(){
	//acknowledgement message
    var message_status = $("#status");
    $("td[contenteditable=true]").blur(function(){
        var field_userid = $(this).attr("id") ;
        var value = $(this).text() ;
        $.post('ajax.php' , field_userid + "=" + value, function(data){
            if(data != '')
			{
				message_status.show();
				message_status.text(data);
				//hide the message
				setTimeout(function(){message_status.hide()},3000);
			}
        });
    });
});
</script>

<?php

$billType=$_REQUEST['tp'];
$billNumber=$_REQUEST['bn'];

if($billType=='Sales')
{	
	$cid=$_REQUEST['cid'];
	$table = TABLE_TIN_SALES;
	$cat = 'tin_sales';
}
else if($billType=='Purchase')
{
	$cid=$_REQUEST['cid'];
	$table = TABLE_TIN_PURCHASE;
	$cat = 'tin_purchase';
}
else if($billType=='SR')
{
	$cid=$_REQUEST['cid'];
	$table = TABLE_TIN_SR;
	$cat = 'tin_sr';
}
else if($billType=='PR')
{
	$cid=$_REQUEST['cid'];
	$table = TABLE_TIN_PR;
	$cat = 'tin_pr';
}
else if($billType=='Local')
{
	$cid=0;
	$table = TABLE_DIRECT_LOCAL_BILLING;
	$cat = 'direct_local';
}


$pageResult=$db->query("SELECT * FROM $table WHERE ".$cat."_bill_number=$billNumber");

?>

			<div>
				<ul class="breadcrumb">
					<li>
						<a href="#">Home</a> <span class="divider">/</span>
					</li>
					<li>
						<a href="#">Bill Detail</a>
					</li>
				</ul>
			</div>
			
			<div>		
				<div class="box span12">
					<div class="box-content">
						<table class="table table-bordered">
							  <thead>
								  <tr>
									  <th>S.N.</th>
									  <th>Description Of Goods</th>
									  <th>Quantity</th>
									  <th>Unit Price</th>
									  <th>Total Price</th>
									  <th>CGST %</th>
									  <th>CGST Amount</th>
									  <th>SGST %</th>
									  <th>SGST Amount</th>
									  <th>Amount (Rs.)</th>                                          
								  </tr>
							  </thead>   
							  <tbody>
							 
								<?php
									
									$i=1;
									while($row=$db->fetchNextObject($pageResult))
									{
									
									?>
										<tr>
											<td class="center" name="sn" id="sn"><?php echo $i ?></td>
											<td class="center" name="desc" id="desc"><?php $a = $cat."_bill_description"; echo $row->$a; ?></td>
											<td class="center" name="quantity" id="quantity"><?php $a = $cat."_bill_quantity"; echo $row->$a; ?></td>
											<td class="center" name="unitPrice" id="unitPrice"><?php $a = $cat."_bill_unit_price"; echo $row->$a; ?></td>
											<td class="center" name="totalPrice" id="totalPrice"><?php if($billType!='Local') { $a = $cat."_bill_total_price"; echo $row->$a; }?></td>
											<td class="center" name="cgstPer" id="cgstPer"><?php if($billType!='Local') { $a = $cat."_bill_cgst"; echo $row->$a; }?></td>
											<td class="center" name="cgstAmt" id="cgstAmt"><?php if($billType!='Local') { $a = $cat."_bill_cgst_amount"; echo $row->$a; }?></td>
											<td class="center" name="rgstPer" id="rgstPer"><?php if($billType!='Local') { $a = $cat."_bill_rgst"; echo $row->$a; }?></td>
											<td class="center" name="rgstAmt" id="rgstAmt"><?php if($billType!='Local') { $a = $cat."_bill_rgst_amount"; echo $row->$a; }?></td>
											<td class="center" name="amount" id="amount"><?php $a = $cat."_bill_total_amount"; echo $row->$a; ?></td>
										</tr>
										<?php
										$i++;
									} 
							 ?>
								<tr>
									<td colspan="10">
										<div align="center">
											<a target="_blank" href="<?php echo FILE_GEN_FIND_BILL_DETAIL."?bn=".$billNumber."&tp=".$billType."&cid=".$cid; ?>"><button type="submit" class="btn btn-primary">Generate Bill</button></a>
										</div>
									</td>                                  
								</tr>                                 
							  </tbody>
						 </table> 
					</div>				
				</div><!--/span-->
			</div><!--/row-->
