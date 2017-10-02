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


function myCalFunction(idx) 
{
     var first = parseFloat(document.getElementsByName('quantity')[idx].innerText);
	 var second = parseFloat(document.getElementsByName('unitPrice')[idx].innerText);
	 
	if(first>0 && second>0)
	{
		var quantityNodes = document.getElementsByName('quantity');
		var untPriceNodes = document.getElementsByName('unitPrice');
		var ttlPriceNodes = document.getElementsByName('totalPrice');
		var ttlvatNodes = document.getElementsByName('totalvat');
		var cgstPerNodes = document.getElementsByName('cgstPer');
		var cgstAmtNodes = document.getElementsByName('cgstAmt');
		var rgstPerNodes = document.getElementsByName('rgstPer');
		var rgstAmtNodes = document.getElementsByName('rgstAmt');
		var amtNodes = document.getElementsByName('amount');
		
		var untPrice = parseFloat(untPriceNodes[idx].innerText).toFixed(2);
		var quantity = parseFloat(quantityNodes[idx].innerText).toFixed(2);

		var total = untPrice*quantity;


		
		var vat = 		parseInt(ttlvatNodes[idx].innerText).toFixed(2);			
								
		

		var vatAmt = (vat/100)*total;
		var amt = total+vatAmt;
		 var amount = amt.toFixed();
		
		untPriceNodes[idx].innerText=untPrice;
		ttlPriceNodes[idx].innerText=(untPrice*quantity).toFixed();
		cgstPerNodes[idx].innerText=vat/2;
		cgstAmtNodes[idx].innerText=(vatAmt/2).toFixed();
		rgstPerNodes[idx].innerText=vat/2;
		rgstAmtNodes[idx].innerText=(vatAmt/2).toFixed();
		amtNodes[idx].innerText=amount;
		
		var snD = parseInt(document.getElementsByName('sn')[idx].innerText);
		var descD = document.getElementsByName('desc')[idx].innerText;
		var ttlPriceD = (untPrice*quantity).toFixed();
		var vatAmtD = (vatAmt*quantity).toFixed();
		var cgstPer = vat/2;
		var cgstAmt = vatAmtD/2;
		var rgstPer = vat/2;
		var rgstAmt = vatAmtD/2;
		var allData = [snD,descD,quantity,untPrice,ttlPriceD,cgstPer,cgstAmt,rgstPer,rgstAmt,amount];
		
		document.getElementsByName('salesData[]')[idx].value = allData;
		
		return true;
	}
}



function hideShow() 
{
	var clnt = document.getElementById('client').value;
	if(clnt==1)
	{
		document.getElementById('extra').style.visibility = 'visible'; 
	}
	else
	{
		document.getElementById('extra').style.visibility = 'hidden';
	}
	
	return true;
}

function validate() 
{
	var totalAmount = document.getElementsByName('totalPrice');
	
	if(totalAmount[0].innerText=='')
	{
		alert("No Any Valid Data For Billing !"); 
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
						<a href="#">Sales Billing</a>
					</li>
				</ul>
			</div>
			
			<div>		
				<div class="box span12">
				
				<form name="tinnsalesbill" class="form-horizontal" method="post" target="_blank" action="<?php echo FILE_TIN_GEN_SALES_BILLING ; ?>" enctype="multipart/form-data"onsubmit="return validate();">
				
					<div class="box-header well" data-original-title>
						<h2><i class="icon-user"></i> Select Party :- </h2> 
						<div class="controls">
						  <select name="client" id="client" data-rel="chosen" onchange="return hideShow();">
							<?php 
								
								$pageResult=$db->query("SELECT * FROM ".TABLE_CLIENT." WHERE client_status='A'");
								while($resultRow=$db->fetchNextObject($pageResult))
								{
									echo "<option value='$resultRow->client_id'>$resultRow->client_firm_name</option>";
								}
							?>
						  </select>
						  <div style="float:right"> Date:- <input type="text" class="datepicker" name="billdate" id="billdate" required></div>
						</div>
					</div>
					<div class="box-header well" data-original-title id="extra">
						<div>
						  <div style="float:left"> Name:- <input type="text" name="clientName" id="clientName" onkeypress="return onKeyPressBlockNumbers(event);"></div>
						  <div style="float:left">&nbsp;&nbsp;&nbsp; Address:- <input type="text" name="clientAddress" id="clientAddress"></div>
						  <div style="float:left">&nbsp;&nbsp;&nbsp; Contact No:- <input type="phone" name="clientPhone" id="clientPhone" onkeypress="return numbersonly(event);"></div>
						</div>
					</div>
					<div class="box-content">
						<table class="table table-bordered">
							  <thead>
								  <tr>
									  <th>S.N.</th>
									  <th>Description Of Goods</th>
									  <th>Quantity</th>
									  <th>Unit Price</th>
									  <th>Total Price</th>
									  <th>GST</th>
									  <th>CGST %</th>
									  <th>CGST Amount</th>
									  <th>RGST %</th>
									  <th>RGST Amount</th>
									  <th>Amount (Rs.)</th>                                          
								  </tr>
							  </thead>   
							  <tbody>
							 
								<?php
									
									for($i=0;$i<=20;$i++)
									{
										echo '<tr>
											<td class="center" name="sn" id="sn" contenteditable="true"></td>
											<td class="center" name="desc" id="desc" contenteditable="true"></td>
											<td class="center" name="quantity" id="quantity" contenteditable="true"></td>
											<td class="center" name="unitPrice" id="unitPrice" contenteditable="true"></td>
											<td class="center" name="totalPrice" id="totalPrice"></td>
											<td class="center" name="totalvat" id="totalvat" contenteditable="true" onfocusout="return myCalFunction('.$i.');"></td>
											<td class="center" name="cgstPer" id="cgstPer"></td>
											<td class="center" name="cgstAmt" id="cgstAmt"></td>
											<td class="center" name="rgstPer" id="rgstPer"></td>
											<td class="center" name="rgstAmt" id="rgstAmt"></td>
											<td class="center" name="amount" id="amount"></td>
											<input type="hidden" name="salesData[]" id="salesData[]" />                                   
										</tr> ';
									} 
							 ?>
							<tr>
								<td colspan="10">
									<div align="center">
										<button type="submit" class="btn btn-primary">Generate Bill</button>
									</div>
								</td>                                  
							</tr>                                 
							  </tbody>
						 </table> 
					</div>
				</form>
				
				</div><!--/span-->
			</div><!--/row-->
