<?php

if(isset($_REQUEST['submit']))
{
	$cur=$_REQUEST['oldPass'];
	$new=$_REQUEST['newPass'];
	$conf=$_REQUEST['conPass'];
	$id=$_SESSION['loginID'];
	$pass=md5($cur);
	$dnew=md5($new);
	
	if($cur=="" or $new=="" or $conf=="")
	{
	
		$_SESSION['msg']="<font color='#FF0000'>Fill all the fields !</font>";
		$_SESSION['temp']="fail";
	}
	else
	{
		$s="select password from tbl_admin where admin_id=$id";
		$res=mysql_query($s);
		  $data1=mysql_fetch_array($res);
		  $data=$data1['password'];
		  
		  if($data!=$pass)
		  {
		  $_SESSION['msg']="<font color='#FF0000'>Current Password Don't Match !</font>";
		  $_SESSION['temp']="fail";
		  }
		  else
		  {
		  
			  if($new!=$conf)
			  {
			  
			  $_SESSION['msg']="<font color='#FF0000'>New Password Don't Match !</font>";
			  $_SESSION['temp']="fail";
			  
			  }
			  else
			  {
			  
			 	$sql="update tbl_admin set password='$dnew' where admin_id='$id'";
				mysql_query($sql);
				$_SESSION['msg']="<font color='#FF00FF'>Password Updated Successfully !</font>";
			  	$_SESSION['temp']="pass";
			  }
		  }
	}
}
?>
	
	
	
	
	<div>
				<ul class="breadcrumb">
					<li>
						<a href="#">Home</a> <span class="divider">/</span>
					</li>
					<li>
						<a href="#">Change Password</a>
					</li>
				</ul>
			</div>
			
			<div class="row-fluid sortable">
				<div class="box span12">
					<div class="box-header well" data-original-title>
						<h2><i class="icon-edit"></i> Change Password</h2>
					</div>
					<div class="box-content">
						<form class="form-horizontal" method="post" enctype="multipart/form-data">
						  <fieldset>
							<?php if(isset($_REQUEST['submit'])) { echo "<legend align='center'>".$_SESSION['msg']."</legend> "; unset($_SESSION['msg']); } ?>
							<div class="control-group">
							  <label class="control-label" for="oldPass">Old Password*</label>
							  <div class="controls">
								 <input class="input-xlarge focused" name="oldPass" id="oldPass" type="password">
							  </div>
							</div>
							<div class="control-group">
							  <label class="control-label" for="newPass">New Password*</label>
							  <div class="controls">
								<input class="input-xlarge focused" name="newPass" id="newPass" type="password">
							  </div>
							</div>

							<div class="control-group">
							  <label class="control-label" for="conPass">Confirm Password*</label>
							  <div class="controls">
								<input class="input-xlarge focused" name="conPass" id="conPass" type="password">
							  </div>
							</div>
							<div class="form-actions">
							  <button type="submit" name="submit" id="submit" class="btn">Save changes</button>
							  <button type="reset" class="btn">Cancel</button>
							</div>
						  </fieldset>
						</form>   

					</div>
				</div><!--/span-->

			</div><!--/row-->