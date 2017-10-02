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
	if(parseFloat(document.getElementsByName('unitPrice')[idx].innerText)>0 && parseFloat(document.getElementsByName('quantity')[idx].innerText)>0)
	{
		var quantityNodes = document.getElementsByName('quantity');
		var untPriceNodes = document.getElementsByName('unitPrice');
		var totalAmountNodes = document.getElementsByName('totalAmount');
		
		var quantity = parseFloat(quantityNodes[idx].innerText).toFixed(2);
		var untPrice = parseFloat(untPriceNodes[idx].innerText).toFixed(2);
		var totalAmount = parseFloat(quantity*untPrice).toFixed(2);
		
		quantityNodes[idx].innerText=quantity;
		untPriceNodes[idx].innerText=untPrice;
		totalAmountNodes[idx].innerText=totalAmount;
		
		var snD = parseInt(document.getElementsByName('sn')[idx].innerText);
		var descD = document.getElementsByName('desc')[idx].innerText;
		
		var allData = [snD,descD,quantity,untPrice,totalAmount];
		
		document.getElementsByName('cashData[]')[idx].value = allData;
		
		return true;
	}
}

function validate() 
{
	var clnt = document.getElementById('clientName').value;
	var phone = document.getElementById('clientPhone').value;
	var date = document.getElementById('billdate').value;
	
	var totalAmount = document.getElementsByName('totalAmount');
	
	if(clnt=='' || phone=='' || date=='')
	{
		alert("Enter Mendatory Fields !"); 
		return false;
	}
	else if(totalAmount[0].innerText=='')
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
						<a href="#">Local Cash Billing</a>
					</li>
				</ul>
			</div>
			
			<div>		
				<div class="box span12">
				
				<form name="localbill" class="form-horizontal" method="post" target="_blank" action="<?php echo FILE_GEN_LOCAL_BILLING ; ?>" enctype="multipart/form-data" onsubmit="return validate();">
					<div class="box-header well" data-original-title id="extra">
						<div>
						  <div style="float:left"> Name* :- <input type="text" name="clientName" id="clientName" onkeypress="return onKeyPressBlockNumbers(event);"></div>
						  <div style="float:left">&nbsp;&nbsp;&nbsp; Contact No* :- <input type="phone" name="clientPhone" id="clientPhone" onkeypress="return numbersonly(event);"></div>
						  <div style="float:right"> Date* :- <input type="text" class="datepicker" name="billdate" id="billdate"></div>
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
									  <th>Total Amount (Rs.)</th>                                          
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
											<td class="center" name="unitPrice" id="unitPrice" contenteditable="true" onfocusout="return myCalFunction('.$i.');"></td>
											<td class="center" name="totalAmount" id="totalAmount"></td>
											<input type="hidden" name="cashData[]" id="cashData[]" />                                   
										</tr> ';
									} 
							 ?>
								<tr>
									<td colspan="8">
										<div align="center">
											<button type="submit" class="btn btn-primary">Generate Bill</button>
											<button type="reset" class="btn">Cancel</button>
										</div>
									</td>                                  
								</tr>                                 
							  </tbody>
						 </table> 
					</div>
				</form>
				
				</div><!--/span-->
			</div><!--/row-->
