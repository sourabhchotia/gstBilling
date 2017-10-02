<?php
if(isset($_REQUEST['dvid']))
{

$vatId=$_REQUEST['dvid'];
$delete=$db->query("DELETE FROM " . TABLE_VAT. "  WHERE vat_id = $vatId ");

}
elseif(isset($_REQUEST['dsts']))
{

$vatId=$_REQUEST['dsts'];
$vatSql=$db->query("SELECT * FROM " . TABLE_VAT. "  WHERE vat_id = $vatId ");
$ans=$db->fetchNextObject($vatSql);
$imgs=$ans->vat_status;
$status='';
if($ans->vat_status=='A') $status='I'; else $status='A';
$vatSql1=$db->query("UPDATE ".TABLE_VAT." SET vat_status='$status' WHERE vat_id = $vatId");
										
}
else
{
$vatId=$_REQUEST['vid'];
}

$tbl_name=TABLE_VAT;		//your table name
$pageResult=$db->query("SELECT * FROM $tbl_name where vat_id = $vatId");
$vatRow=$db->fetchNextObject($pageResult)		
?>




			<div>
				<ul class="breadcrumb">
					<li>
						<a href="#">Home</a> <span class="divider">/</span>
					</li>
					<li>
						<a href="#">VAT Detail</a>
					</li>
				</ul>
			</div>
			
			<div class="row-fluid sortable">		
				<div class="box span12">
					<div class="box-header well" data-original-title>
						<h2><i class="icon-user"></i> <?php echo $vatRow->vat_cat; ?></h2>
						<div align="center">
							<a class="btn btn-info" href="index.php?c=dVa&edt=<?php echo $vatRow->vat_id; ?>">
								<i class="icon-edit icon-white"></i>  
								Edit                                            
							</a>
									
							&nbsp;&nbsp;&nbsp;
							<a class="btn btn-danger" href="index.php?c=tMg&vid=<?php echo $vatRow->vat_id; ?>">
								<i class="icon-trash icon-white"></i> 
								Delete
							</a>
							
							&nbsp;&nbsp;&nbsp;
							<a class="btn btn-success" href="index.php?c=tDe&dsts=<?php echo $vatRow->vat_id; ?>">
								<i class="icon-trash icon-white"></i> 
								<?php if($vatRow->vat_status=='A') echo 'InActive' ; 
								else echo 'Active'; 
								?>									
							</a>
						</div>
					</div>
					<div class="box-content">
						<table  class=" table table-striped table-bordered">
						  <tbody align="center">
						  	<tr>
								<td width="40%">Vat Id</td>
								<td><?php echo $vatRow->vat_id; ?></td>
							</tr>
							<tr>
								<td width="40%">Vat Category</td>
								<td><?php echo $vatRow->vat_cat; ?></td>
							</tr>
							<tr>
								<td width="40%">Vat Rate</td>
								<td><?php echo $vatRow->vat_rate; ?></td>
							</tr>
							<tr>
								<td width="40%">Effective Date</td>
								<td><?php echo $vatRow->vat_effective_date; ?></td>
							</tr>
							
							<tr>
								<td width="40%">Status</td>
								<td><?php if($vatRow->vat_status=='A') echo 'Active' ;  else echo 'InActive';  ?>	</td>
							</tr>
						  </tbody>
					  </table>            
					</div>
				</div><!--/span-->
			
			</div><!--/row-->