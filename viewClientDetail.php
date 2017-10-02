<?php
if(isset($_REQUEST['dcid']))
{

$clientId=$_REQUEST['dcid'];
$delete=$db->query("DELETE FROM " . TABLE_CLIENT. "  WHERE client_id = $clientId ");

}
else if(isset($_REQUEST['dsts']))
{

$clientId=$_REQUEST['dsts'];
$clientSql=$db->query("SELECT * FROM " . TABLE_CLIENT. "  WHERE client_id = $clientId ");
$ans=$db->fetchNextObject($clientSql);
$imgs=$ans->client_status;
$status='';
if($ans->client_status=='A') $status='I'; else $status='A';
$clientSql1=$db->query("UPDATE ".TABLE_CLIENT." SET client_status='$status' WHERE client_id = $clientId");
										
}
else
{
$clientId=$_REQUEST['cid'];
}
$tbl_name=TABLE_CLIENT;		//your table name
$pageResult=$db->query("SELECT * FROM $tbl_name where client_id = $clientId");
$clientRow=$db->fetchNextObject($pageResult)		
?>




			<div>
				<ul class="breadcrumb">
					<li>
						<a href="#">Home</a> <span class="divider">/</span>
					</li>
					<li>
						<a href="#">Client Detail</a>
					</li>
				</ul>
			</div>
			
			<div class="row-fluid sortable">		
				<div class="box span12">
					<div class="box-header well" data-original-title>
						<h2><i class="icon-user"></i> <?php echo $clientRow->client_name; ?></h2>
						<div align="center">
							<a class="btn btn-info" href="index.php?c=ien&edt=<?php echo $clientRow->client_id; ?>">
								<i class="icon-edit icon-white"></i>  
								Edit                                            
							</a>
									
							&nbsp;&nbsp;&nbsp;
							<a class="btn btn-danger" href="index.php?c=ntM&cid=<?php echo $clientRow->client_id; ?>">
								<i class="icon-trash icon-white"></i> 
								Delete
							</a>
							
							&nbsp;&nbsp;&nbsp;
							<a class="btn btn-success" href="index.php?c=ntD&dsts=<?php echo $clientRow->client_id; ?>">
								<i class="icon-trash icon-white"></i> 
								<?php if($clientRow->client_status=='A') echo 'InActive' ; 
								else echo 'Active'; 
								?>									
							</a>
						</div>
					</div>
					<div class="box-content">
						<table  class=" table table-striped table-bordered">
						  <tbody align="center">
						  	<tr>
								<td width="40%">Name</td>
								<td><?php echo $clientRow->client_name; ?></td>
							</tr>
							<tr>
								<td width="40%">Address</td>
								<td><?php echo $clientRow->client_address; ?></td>
							</tr>
							<tr>
								<td width="40%">City</td>
								<td><?php echo $clientRow->client_city; ?></td>
							</tr>
							<tr>
								<td width="40%">State</td>
								<td><?php echo $clientRow->client_state; ?></td>
							</tr>
							<tr>
								<td width="40%">Pincode</td>
								<td><?php echo $clientRow->client_pincode; ?></td>
							</tr>
							<tr>
								<td width="40%">Rate</td>
								<td><?php echo $clientRow->client_rate; ?></td>
							</tr>
							<tr>
								<td width="40%">Contact No</td>
								<td><?php echo $clientRow->client_mobile; ?></td>
							</tr>
							<tr>
								<td width="40%">Email</td>
								<td><?php echo $clientRow->client_email; ?></td>
							</tr>
							<tr>
								<td width="40%">Status</td>
								<td><?php if($clientRow->client_status=='A') echo 'Active' ;  else echo 'InActive';  ?>	</td>
							</tr>
						  </tbody>
					  </table>            
					</div>
				</div><!--/span-->
			
			</div><!--/row-->