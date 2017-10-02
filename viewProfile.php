<?php
if(isset($_POST['save']))
{
  	if($_REQUEST['userName']=='' || $_REQUEST['firstName']=='' || $_REQUEST['lastName']=='' || $_REQUEST['address']=='' || $_REQUEST['mobile']=='')
	{
	 $_SESSION['msg']="<font color='#FF0000'>Please Enter All The Mendetry fields!</font>";
	}
	else
	{
		$clientId=$_SESSION['loginID'];	
		$query="UPDATE ".TABLE_ADMIN." SET 
							username='".$_REQUEST["userName"]."',
							fname='".$_REQUEST["firstName"]."',
							lname='".$_REQUEST["lastName"]."',
							email='".$_REQUEST["email"]."',
							fax='".$_REQUEST["fax"]."',
							mobile='".$_REQUEST["mobile"]."',
							address='".$_REQUEST["address"]."'
							WHERE admin_id = $clientId";
		if($db->query($query))
		{
			$_SESSION['msg']="<font color='#FF00FF'>Profile updated Successfully!</font>"; 
		}
		else
		{
			$_SESSION['msg']="<font color='#FF0000'>Error in process!</font>";  
		}
	}
}

$clientId=$_SESSION['loginID'];
$clientSql=$db->query("SELECT * FROM ".TABLE_ADMIN." WHERE admin_id = $clientId");
$ans=$db->fetchNextObject($clientSql);
$username=$ans->username;
$fname=$ans->fname;
$lname=$ans->lname;
$email=$ans->email;
$fax=$ans->fax;
$mobile=$ans->mobile;
$address=$ans->address;

$_SESSION['fname']=$ans->fname;
$_SESSION['lname']=$ans->lname;
?>

	<div>
				<ul class="breadcrumb">
					<li>
						<a href="#">Home</a> <span class="divider">/</span>
					</li>
					<li>
						<a href="#">View Profile</a>
					</li>
				</ul>
			</div>
			
			<div class="row-fluid sortable">
				<div class="box span12">
					<div class="box-header well" data-original-title>
						<h2><i class="icon-edit"></i> <?php echo $_SESSION['fname']." ".$_SESSION['lname'];?></h2>
					</div>
					<div class="box-content">
						<form class="form-horizontal" method="post" enctype="multipart/form-data">
						  <fieldset>
							<?php if(isset($_REQUEST['save'])) { echo "<legend align='center'>".$_SESSION['msg']."</legend> "; unset($_SESSION['msg']); } ?>
							<div class="control-group">
							  <label class="control-label" for="typeahead">Username* </label>
							  <div class="controls">
								<input class="input-xlarge focused" name="userName" id="userName" type="text" value="<?php echo $username; ?>">
							  </div>
							</div>
							<div class="control-group">
							  <label class="control-label" for="typeahead">First Name* </label>
							  <div class="controls">
								<input class="input-xlarge focused" name="firstName" id="firstName" type="text" value="<?php echo $fname; ?>" onkeypress="return onKeyPressBlockNumbers(event);">
							  </div>
							</div>
							<div class="control-group">
							  <label class="control-label" for="typeahead">Last Name* </label>
							  <div class="controls">
								<input class="input-xlarge focused" name="lastName" id="lastName" type="text" value="<?php echo $lname; ?>" onkeypress="return onKeyPressBlockNumbers(event);">
							  </div>
							</div>
							<div class="control-group">
							  <label class="control-label" for="typeahead">Email </label>
							  <div class="controls">
								<input class="input-xlarge focused" name="email" id="email" type="email" value="<?php echo $email; ?>">
							  </div>
							</div>
							<div class="control-group">
							  <label class="control-label" for="typeahead">Fax No </label>
							  <div class="controls">
								<input class="input-xlarge focused" name="fax" id="fax" type="phone" value="<?php echo $fax; ?>" onkeypress="return numbersonly(event);">
							  </div>
							</div>
							<div class="control-group">
							  <label class="control-label" for="typeahead">Contact No* </label>
							  <div class="controls">
								<input class="input-xlarge focused" name="mobile" id="mobile" type="phone" value="<?php echo $mobile; ?>" onkeypress="return numbersonly(event);">
							  </div>
							</div>
							<div class="control-group">
							  <label class="control-label" for="textarea2">Address*</label>
							  <div class="controls">
								<textarea class="cleditor" name="address" id="address" rows="3"><?php echo $address; ?></textarea>
							  </div>
							</div>
							<div class="form-actions">
							  <button type="submit" name="save" id="save" class="btn btn-primary">Save changes</button>
							</div>
						  </fieldset>
						</form>   

					</div>
				</div><!--/span-->

			</div><!--/row-->