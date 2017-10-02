<?php
function paging($pagename,$pageindex,$args,$totalpages)
{
$page_bar=10;
$page_bar_mid=floor($page_bar/2);
$page_start=1;																		
$page_end=$totalpages;																												
if($totalpages>$page_bar)
{
	$page_end=$page_bar;
}
if($pageindex>$page_bar_mid && $totalpages>$page_bar)
{
	if($totalpages>$pageindex+$page_bar_mid)
	{
		$page_start=$pageindex-($page_bar_mid-1);
		$page_end=$pageindex+($page_bar_mid+1);
	}																		
	else
	{		
		$page_start=$totalpages-($page_bar-1);		
		$page_end=$totalpages;
	}																			
}	
?> 
<style>
td.paging span,
td.paging span.selected,
td.paging a {
	display: block;
	float: left;
}

.listingFilter div.paging {
	margin-right: -4px;
}

td.paging a {
	margin: 0 2px 0 2px;
	padding: 0 2px 0 2px;
}

.selPg {
	color: white; 
	background-color: #FE8C29;
	border: 1px solid #FE8C29;
	padding: 0 2px 0 2px;
}

</style>
<table  cellspacing=0 cellpadding=0 border="0"> 
	<tr>
		<td   class='BdrT5' style='padding-top:5px'>
			<table cellspacing=0 cellpadding=0 border=0>
				<tr>
					<td class='gen' ><span>&nbsp;</span></td>
	
					<?php if(($pageindex > $page_bar_mid) && ($totalpages>$page_bar)) { ?>
					<td class='paging floatr' style='font-family:verdana;font-size:10pt'>...</td> 
						<td class='paging floatr' style='font-family:verdana;font-size:10pt'><a href='<?php echo $pagename."&p=0".$args ?>' class='Blue10 udl'><span  class="Light2" style="cursor:pointer"><strong>First</strong></span></a></td> 					
					<?php }
					
						for($i=$page_start;$i<=$page_end;$i++) {					
							if($i==$pageindex+1)
							{ 
							 ?><td class='paging floatr selPg' style='font-family:verdana;font-size:10pt'><strong><?php echo $i;?></strong></span></td><?php
							}else{ 																			
								?><td class='paging floatr' style='font-family:verdana;font-size:10pt'><a href='<?php echo $pagename."&p=".($i-1).$args ?>' class='Blue10 udl'><strong><?php echo $i;?></strong></a></td><?php
							}																				
						} 
						if(($pageindex+$page_bar_mid < $totalpages-1) && ($totalpages > $page_bar)) { 
						?><td  class='paging floatr' style='font-family:verdana;font-size:10pt'>...</td>
						<td  class='paging floatr' style='font-family:verdana;font-size:10pt'><a href='<?php echo $pagename."&p=".($totalpages-1).$args ?>' class='Blue10 udl'><span  class="Light2" style="cursor:pointer"><strong>Last</strong></span></a></td>
						<?php 
						}
					?>
				</tr>
			</table>
		</td>
	</tr>	
</table>
<?php 
 } 	
 ?>