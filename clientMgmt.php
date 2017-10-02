<?php
if(isset($_REQUEST['cid']))
{

$clientId=$_REQUEST['cid'];
$delete=$db->query("DELETE FROM " . TABLE_CLIENT. "  WHERE client_id = $clientId ");

}

if(isset($_REQUEST['sts']))
{

$clientId=$_REQUEST['sts'];
$clientSql=$db->query("SELECT * FROM " . TABLE_CLIENT. "  WHERE client_id = $clientId ");
$ans=$db->fetchNextObject($clientSql);
$imgs=$ans->client_status;
$status='';
if($ans->client_status=='A') $status='I'; else $status='A';
$clientSql1=$db->query("UPDATE ".TABLE_CLIENT." SET client_status='$status' WHERE client_id = $clientId");
										
}

$tbl_name=TABLE_CLIENT;		//your table name
$pageResult=$db->query("SELECT * FROM $tbl_name");
$count=$db->numRows($pageResult);
			
?>




			<div>
				<ul class="breadcrumb">
					<li>
						<a href="#">Home</a> <span class="divider">/</span>
					</li>
					<li>
						<a href="#">Client Management</a>
					</li>
				</ul>
			</div>
			
			<div class="row-fluid sortable">		
				<div class="box span12">
					<div class="box-header well" data-original-title>
						<h2><i class="icon-user"></i> All Clients</h2>
						<div align="right">
							<a class="btn btn-info" href="index.php?c=ien">
								<i class="icon-plus icon-white"></i>  
								Add New                                            
							</a>
						</div>
					</div>
					<div class="box-content">
						<table class="table table-striped table-bordered bootstrap-datatable datatable">
						  <thead>
							  <tr>
								  <th>Name</th>
								  <th>Address</th>
								  <th>City</th>
								  <th>State</th>
								  <th>Pincode</th>
								  <th>Contact</th>
								  <th>Email</th>
								  <th>Rate</th>
								  <th>Status</th>
								  <th>Actions</th>
							  </tr>
						  </thead>
						  <tbody>
						  <?php
									
							if($count)
							{ 
								while($clientRow=$db->fetchNextObject($pageResult))
								{
						  ?>
						  
							<tr>
								<td><?php echo $clientRow->client_name; ?></td>
								<td width="10%"><?php echo $clientRow->client_address; ?></td>
								<td><?php echo $clientRow->client_city; ?></td>
								<td><?php echo $clientRow->client_state; ?></td>
								<td><?php echo $clientRow->client_pincode; ?></td>
								<td><?php echo $clientRow->client_mobile; ?></td>
								<td><?php echo $clientRow->client_email; ?></td>
								<td><?php echo $clientRow->client_rate; ?></td>
								<td class="center">
									<a href="index.php?c=ntM&sts=<?php echo $clientRow->client_id; ?>">
										<?php if($clientRow->client_status=='A') echo '<span class="label label-success">Active</span>' ; 
										else echo '<span class="label">Inactive</span>'; 
										?>									
									</a>
								</td>
								<td class="center">
									<a class="btn btn-success" href="index.php?c=ntD&cid=<?php echo $clientRow->client_id; ?>">
										<i class="icon-zoom-in icon-white"></i>  
										View                                            
									</a>
									<a class="btn btn-info" href="index.php?c=ien&edt=<?php echo $clientRow->client_id; ?>">
										<i class="icon-edit icon-white"></i>  
										Edit                                            
									</a>
									<a class="btn btn-danger" href="index.php?c=ntM&cid=<?php echo $clientRow->client_id; ?>">
										<i class="icon-trash icon-white"></i> 
										Delete
									</a>
								</td>
							</tr>
						
						<?php
							}
							}
							else
							{
						?>
								<tr>
									<td class="center" colspan="9" align="center">No Record Found</td>
								</tr>
						<?php
						}
						
						?>	
							
						  </tbody>
					  </table>            
					</div>
				</div><!--/span-->
			
			</div><!--/row-->