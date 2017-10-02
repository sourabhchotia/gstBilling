			<div>
				<ul class="breadcrumb">
					<li>
						<a href="#">Home</a> <span class="divider">/</span>
					</li>
					<li>
						<a href="#">Dashboard</a>
					</li>
				</ul>
			</div>
			<div class="sortable row-fluid">
				<a data-rel="tooltip" title="" class="well span3 top-block" href="#">
					<span class="icon32 icon-red icon-user"></span>
					<div>Total Clients</div>
					<div><?php  $result=$db->query("SELECT COUNT(*) AS sum FROM ".TABLE_CLIENT);
								$sum = mysql_fetch_assoc($result); echo $sum['sum']; ?></div>
				</a>

				<a data-rel="tooltip" title="" class="well span3 top-block" href="#">
					<span class="icon32 icon-color icon-cart"></span>
					<div>GST Sale</div>
					<div><?php  $result=$db->query("SELECT SUM(tin_sales_bill_total_amount) AS sum FROM ".TABLE_TIN_SALES);
								$sum = mysql_fetch_assoc($result); echo $sum['sum']; ?></div>
				</a>
				
				<a data-rel="tooltip" title="" class="well span3 top-block" href="#">
					<span class="icon32 icon-blue icon-cart"></span>
					<div>Local Sale</div>
					<div><?php  $result=$db->query("SELECT SUM(direct_local_bill_total_amount) AS sum FROM ".TABLE_DIRECT_LOCAL_BILLING);
								$sum = mysql_fetch_assoc($result); echo $sum['sum']; ?></div>
				</a>
			</div>
			