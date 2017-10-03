
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
     var first = parseFloat(document.getElementsByName('weight')[idx].innerText);
	 var second = parseFloat(document.getElementsByName('rate')[idx].innerText);
	 
	if(first>0 && second>0)
	{
		first = (first/1000);
		var amtNodes = document.getElementsByName('amount');
		amount = first * second;
		amtNodes[idx].innerText=amount;
		
		var snD = parseInt(document.getElementsByName('sn')[idx].innerText);
		var cno = document.getElementsByName('cno')[idx].innerText;
		var date = document.getElementsByName('date')[idx].innerText;
		var item = document.getElementsByName('item')[idx].innerText;
		var weight = document.getElementsByName('weight')[idx].innerText;
		var rate = document.getElementsByName('rate')[idx].innerText;
		var from = document.getElementsByName('from')[idx].innerText;
		var to = document.getElementsByName('to')[idx].innerText;
		var allData = [snD,cno,date,item,weight,rate,from,to,amount];
		
		document.getElementsByName('salesData[]')[idx].value = allData;
		
		return true;
	}
}



function hideShow() 
{
	var clnt = document.getElementById('client').value;

	if(clnt==0)
	{
		document.getElementById('extra').style.visibility = 'visible'; 
	}
	else
	{
		document.getElementById('extra').style.visibility = 'hidden';
	}
	
	 $rate = $("#client option:selected").data('price');
	 // alert($rate);
	 $(".xxx").html($rate);
	 // $("#rate").value($rate);
	return true;
}


$( ".chzn-single" ).click(function() {
  alert( "Handler for .click() called." );
});

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
						  <select name="client" id="client" onclick="hideShow();">
							<?php 
								
								$pageResult=$db->query("SELECT * FROM ".TABLE_CLIENT." WHERE client_status='A'");
								echo "<option value = 0>Cash</option>";
								while($resultRow=$db->fetchNextObject($pageResult))
								{
									echo "<option value='$resultRow->client_id' data-price='$resultRow->client_rate' >$resultRow->client_name</option>";

								}

							?>
						  </select>
						  <div style="float:right"> Date:- <input type="text" class="datepicker" name="billdate" id="billdate" required></div>
						  <button type="button" id="add_rows" class="btn btn-primary">Add Row</button>
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
									  <th>Consignment No.</th>
									  <th>Date</th>
									  <th>Item</th>
									  <th>Weight</th>
									  <th>Rate</th>
									  <th>From</th>
									  <th>Destination</th> 
									  <th>Amount</th>                                        
								  </tr>
							  </thead>   
							  <tbody id="table_tbody">
							 
								<?php
									for($i=0;$i<1;$i++)
									{
										echo '<tr id="main_trows">
											<td class="center" name="sn" id="sn" contenteditable="true"></td>
											<td class="center" name="cno" id="cno" contenteditable="true"></td>
											<td class="center datepicker" name="date" id="date" contenteditable="true"></td>
											<td class="center" name="item" id="item" contenteditable="true" onfocusout="return myCalFunction('.$i.');"></td>
											<td class="center" name="weight" id="weight" contenteditable="true" onfocusout="return myCalFunction('.$i.');"></td>
											<td class="center xxx" name="rate" id="rate" contenteditable="true" onfocusout="return myCalFunction('.$i.');"></td>
											<td class="center" name="from" id="from" contenteditable="true"></td>
											<td class="center" name="to" id="to" contenteditable="true" onfocusout="return myCalFunction('.$i.');"></td>
											<td class="center" name="amount" id="amount" contenteditable="false"></td>
											<input type="hidden" name="salesData[]" id="salesData[]" />                                   
										</tr> ';
									} 
							 ?>
							 <script type="text/javascript">
							 	$( "#add_rows" ).click(function() {
							 		var rowCount = $('.table tr').length;
							 		--rowCount;
								  $('#table_tbody').append('<tr><td class="center" name="sn" id="sn" contenteditable="true"></td><td class="center" name="cno" id="cno" contenteditable="true"></td><td class="center datepicker" name="date" id="date" contenteditable="true"></td><td class="center" name="item" id="item" contenteditable="true"></td><td class="center" name="weight" id="weight" contenteditable="true" onfocusout="return myCalFunction(' + rowCount + ');"></td><td class="center xxx" name="rate" id="rate" contenteditable="true" onfocusout="return myCalFunction(' + rowCount + ');"></td><td class="center" name="from" id="from" contenteditable="true"></td><td class="center" name="to" id="to" contenteditable="true" onfocusout="return myCalFunction('+rowCount+');"></td><td class="center" name="amount" id="amount" contenteditable="false"></td><input type="hidden" name="salesData[]" id="salesData[]" /></tr>');});
							 	$("#add_rows").click(function(){

							 		setTimeout(hideShow(), 1000);
							 	});
							 </script>
							<!-- <tr >
								<td colspan="10">
									<div align="center">
										<button type="submit" class="btn btn-primary">Save</button>
									</div>
								</td>                                  
							</tr>     -->                             
							  </tbody>
						 </table> 
						 <div align="center">
										<button type="submit" class="btn btn-primary">Save</button>
									</div>
					</div>
				</form>
				
				</div><!--/span-->
			</div><!--/row-->
