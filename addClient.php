<?php
if(isset($_POST['save']))
{
  	if($_REQUEST['name']=='' || $_REQUEST['city']=='' || $_REQUEST['rate']=='' || $_REQUEST['address']=='' || $_REQUEST['contact']=='')
	{
	 $_SESSION['msg']="<font color='#FF0000'>Please Enter All The Mandotry fields!</font>";
	}
	else
	{
		if(isset($_REQUEST['edt']))
		{	
			$clientId=$_REQUEST['edt'];	
			$query="UPDATE ".TABLE_CLIENT." SET 
								client_rate='".$_REQUEST["rate"]."',
								client_name='".$_REQUEST["name"]."',
								client_city='".$_REQUEST["city"]."',
								client_state='".$_REQUEST["state"]."',
								client_pincode='".$_REQUEST["pin"]."',
								client_address='".$_REQUEST["address"]."',
								client_mobile='".$_REQUEST["contact"]."',
								client_email='".$_REQUEST["email"]."'
								WHERE client_id = $clientId";
			if($db->query($query))
			{
				$_SESSION['msg']="<font color='#FF00FF'>Client Info updated Successfully!</font>";
				echo "<script type='text/javascript'>alert('Client Info updated Successfully!');</script>";
				header("Location: index.php?c=ntD&cid=$clientId");
			}
			else
			{
				$_SESSION['msg']="<font color='#FF0000'>Error in process!</font>";  
			}
		}
		else
		{
			$query="INSERT INTO ".TABLE_CLIENT." SET 
								client_rate='".$_REQUEST["rate"]."',
								client_name='".$_REQUEST["name"]."',
								client_city='".$_REQUEST["city"]."',
								client_state='".$_REQUEST["state"]."',
								client_pincode='".$_REQUEST["pin"]."',
								client_address='".$_REQUEST["address"]."',
								client_mobile='".$_REQUEST["contact"]."',
								client_email='".$_REQUEST["email"]."',
								client_status='A'";
								
			if($db->query($query))
			{
				$_SESSION['msg']="<font color='#FF00FF'>Client added Successfully!</font>";
				echo "<script type='text/javascript'>alert('Client added Successfully!');</script>";
				header("Location: index.php?c=ntM");
			}
			else
			{
				$_SESSION['msg']="<font color='#FF0000'>Error in process!</font>";  
			}
		}
	}
}

if(isset($_REQUEST['edt']))
{
	$clientId=$_REQUEST['edt'];
	$clientSql=$db->query("SELECT * FROM ".TABLE_CLIENT." WHERE client_id = $clientId");
	$ans=$db->fetchNextObject($clientSql);
	$name=$ans->client_name;
	$address=$ans->client_address;
	$city=$ans->client_city;
	$state=$ans->client_state;
	$pin=$ans->client_address;
	$mobile=$ans->client_mobile;
	$email=$ans->client_email;
	$rate = $ans->client_rate;
}
else
{
	$name="";
	$address="";
	$city="";
	$state="";
	$pin="";
	$mobile="";
	$email="";
	$rate = "";
}

?>


	<div>
				<ul class="breadcrumb">
					<li>
						<a href="#">Home</a> <span class="divider">/</span>
					</li>
					<li>
						<a href="#">Add Client</a>
					</li>
				</ul>
			</div>
			
			<div class="row-fluid sortable">
				<div class="box span12">
					<div class="box-header well" data-original-title>
						<h2><i class="icon-edit"></i> Add New Client</h2>
					</div>
					<div class="box-content">
						<form class="form-horizontal" method="post" enctype="multipart/form-data">
						  <fieldset>
							<?php if(isset($_REQUEST['save'])) { echo "<legend align='center'>".$_SESSION['msg']."</legend> "; unset($_SESSION['msg']); } ?>
							<div class="control-group">
							  <label class="control-label" for="typeahead">Name* </label>
							  <div class="controls">
								<input class="input-xlarge focused" name="name" id="firmName" type="text" value="<?php echo $name; ?>">
							  </div>
							</div>
							<div class="control-group">
							  <label class="control-label" for="textarea2">Address*</label>
							  <div class="controls">
								<textarea class="cleditor" name="address" id="address" rows="3" value="<?php echo $address; ?>"></textarea>
							  </div>
							</div> 
							<div class="control-group">
							  <label class="control-label" for="typeahead">city* </label>
							  <div class="controls">
								<input class="input-xlarge focused" name="city" id="ownerName" type="text" value="<?php echo $city; ?>" onkeypress="return onKeyPressBlockNumbers(event);">
							  </div>
							</div>
							<div class="control-group">
							  <label class="control-label" for="typeahead">State* </label>
							  <div class="controls">
								<input class="input-xlarge focused" name="state" id="firmType" type="text" value="<?php echo $state; ?>" onkeypress="return onKeyPressBlockNumbers(event);">
							  </div>
							</div>
							<div class="control-group">
							  <label class="control-label" for="typeahead">Pincode* </label>
							  <div class="controls">
								<input class="input-xlarge focused" name="pin" id="tin" type="text" value="<?php echo $pin; ?>" onkeypress="return numbersonly(event);">
							  </div>
							</div>        
							<div class="control-group">
							  <label class="control-label" for="typeahead">Contact No* </label>
							  <div class="controls">
								<input class="input-xlarge focused" name="contact" id="contact" type="phone" value="<?php echo $mobile; ?>" onkeypress="return numbersonly(event);">
							  </div>
							</div>
							<div class="control-group">
							  <label class="control-label" for="typeahead">Email* </label>
							  <div class="controls">
								<input class="input-xlarge focused" name="email" id="email"" type="email" value="<?php echo $email; ?>">
							  </div>
							</div>
							<div class="control-group">
							  <label class="control-label" for="typeahead">Rate per kg* </label>
							  <div class="controls">
								<input class="input-xlarge focused" name="rate" id="rate"" type="text" value="<?php echo $rate; ?>">
							  </div>
							</div>
							<div class="form-actions">
							  <button type="submit" name="save" id="save" class="btn btn-primary">Save changes</button>
							  <button type="reset" class="btn">Cancel</button>
							</div>
						  </fieldset>
						</form>   

					</div>
				</div><!--/span-->

			</div><!--/row-->