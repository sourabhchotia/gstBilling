<?php
if(isset($_POST['save']))
{
  	if($_REQUEST['vatCat']=='' || $_REQUEST['vatRate']=='' || $_REQUEST['vatEffDate']=='')
	{
	 $_SESSION['msg']="<font color='#FF0000'>Please Enter All The Mendetry fields!</font>";
	}
	else
	{
		if(isset($_REQUEST['edt']))
		{	
			$vatId=$_REQUEST['edt'];	
			$query="UPDATE ".TABLE_VAT." SET 
								vat_cat='".$_REQUEST["vatCat"]."',
								vat_rate=".$_REQUEST["vatRate"].",
								vat_effective_date='".date("Y-m-d", strtotime($_REQUEST['vatEffDate']))."'
								WHERE vat_id = $vatId";
			if($db->query($query))
			{
				$_SESSION['msg']="<font color='#FF00FF'>VAT updated Successfully!</font>"; 
				echo "<script type='text/javascript'>alert('VAT updated Successfully!');</script>";
				header("Location: index.php?c=tDe&vid=$vatId");
			}
			else
			{
				$_SESSION['msg']="<font color='#FF0000'>Error in process!</font>";  
			}
		}
		else
		{
			$query="INSERT INTO ".TABLE_VAT." SET 
								vat_cat='".$_REQUEST["vatCat"]."',
								vat_rate=".$_REQUEST["vatRate"].",
								vat_effective_date='".date("Y-m-d", strtotime($_REQUEST['vatEffDate']))."',
								vat_status='A'";
								
			if($db->query($query))
			{
				$_SESSION['msg']="<font color='#FF00FF'>VAT inserted Successfully!</font>";
				echo "<script type='text/javascript'>alert('VAT added Successfully!');</script>";
				header("Location: index.php?c=tMg");
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
	$vatId=$_REQUEST['edt'];
	$vatSql=$db->query("SELECT * FROM ".TABLE_VAT." WHERE vat_id = $vatId");
	$ans=$db->fetchNextObject($vatSql);
	$vatcat=$ans->vat_cat;
	$vatrate=$ans->vat_rate;
	$vateffdate=date("Y-m-d", strtotime($ans->vat_effective_date));
}
else
{
	$vatcat="";
	$vatrate="";
	$vateffdate="";
}

?>


	<div>
				<ul class="breadcrumb">
					<li>
						<a href="#">Home</a> <span class="divider">/</span>
					</li>
					<li>
						<a href="#">Add GST Rate</a>
					</li>
				</ul>
			</div>
			
			<div class="row-fluid sortable">
				<div class="box span12">
					<div class="box-header well" data-original-title>
						<h2><i class="icon-edit"></i> Add New GST Rate</h2>
					</div>
					<div class="box-content">
						<form class="form-horizontal" method="post" enctype="multipart/form-data">
						  <fieldset>
							<?php if(isset($_REQUEST['save'])) { echo "<legend align='center'>".$_SESSION['msg']."</legend> "; unset($_SESSION['msg']); } ?>
							<div class="control-group">
							  <label class="control-label" for="typeahead">GST Category* </label>
							  <div class="controls">
								<input class="input-xlarge focused" name="vatCat" id="vatCat" type="text" value="<?php echo $vatcat; ?>">
							  </div>
							</div>
							<div class="control-group">
							  <label class="control-label" for="typeahead">GST Rate* </label>
							  <div class="controls">
								<input class="input-xlarge focused" name="vatRate" id="vatRate" type="text" value="<?php echo $vatrate; ?>" onkeypress="return numbersonly(event);">
							  </div>
							</div>
							<div class="control-group">
							  <label class="control-label" for="typeahead">Effective Date* </label>
							  <div class="controls">
								<input type="text" class="input-xlarge datepicker" name="vatEffDate" id="vatEffDate" value="<?php echo $vateffdate; ?>">
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