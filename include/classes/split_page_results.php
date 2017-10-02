<?php 
  class splitPageResults {
    function splitPageResults(&$current_page_number, $max_rows_per_page, &$sql_query, &$query_num_rows) {
	  if (empty($current_page_number)) $current_page_number = 1;
      $pos_to = strlen($sql_query);
      $pos_from = strpos($sql_query, ' from', 0);

      $pos_group_by = strpos($sql_query, ' group by', $pos_from);
      if (($pos_group_by < $pos_to) && ($pos_group_by != false)) $pos_to = $pos_group_by;

      $pos_having = strpos($sql_query, ' having', $pos_from);
      if (($pos_having < $pos_to) && ($pos_having != false)) $pos_to = $pos_having;

      $pos_order_by = strpos($sql_query, ' order by', $pos_from);
      if (($pos_order_by < $pos_to) && ($pos_order_by != false)) $pos_to = $pos_order_by;

      $reviews_count_query = tep_db_query("select count(*) as total " . substr($sql_query, $pos_from, ($pos_to - $pos_from)));
      $reviews_count = tep_db_fetch_array($reviews_count_query);
      $query_num_rows = $reviews_count['total'];

      $num_pages = ceil($query_num_rows / $max_rows_per_page);
      if ($current_page_number > $num_pages) {
        $current_page_number = $num_pages;
      }
      $offset = ($max_rows_per_page * ($current_page_number - 1));
       $sql_query .= " limit " . $offset . ", " . $max_rows_per_page; 
    }

    function display_links($query_numrows, $max_rows_per_page, $max_page_links, $current_page_number, $parameters = '', $page_name = 'page',$fontColor='#FFFFFF') {
		
	
      global $PHP_SELF;

      if ( tep_not_null($parameters) && (substr($parameters, -1) != '&') ) $parameters .= '&';

// calculate number of pages needing links
      $num_pages = ceil($query_numrows / $max_rows_per_page);
	  $q = $_SERVER['QUERY_STRING'];
	  $pairs = explode('&',$q);
	  $qstring = "";
	  while (list(, $pair) = each($pairs)) {
	    list($key,$value) = explode('=', $pair);
            if($key !=  $_SESSION['selectedID'] && $key != "page")
			{
			  if($qstring == "")
			     $qstring .= $key . "=" . $value;
			  else
			     $qstring .= "&" . $key . "=" . $value; 	 
			}
	  }		
	  if ($num_pages > 1) { ?> 
          <form name = "pages" method="get" action="<?php echo $_SERVER['PHP_SELF'];?>"> 
          <p class = lighth13>
	   <?php 	  
	   if ($current_page_number > 1) { ?>
          <a href="<?php echo basename($_SERVER['PHP_SELF'])?>?page=<?php echo $current_page_number - 1?><?php if($qstring != "") {?>&<?php echo $qstring ?><?php }?>"> <font color="000000"><?php echo PREVNEXT_BUTTON_PREV;?></font></a>
	   <?php } else { ?>
           <font color="000000"><?php  echo PREVNEXT_BUTTON_PREV ; ?></font><?php
        }  ?>
         <font color="000000"><?php echo "page  " ;?></font>
	   
	   <?php 
	    $q1 = $_SERVER['QUERY_STRING'];
	    $pairs1 = explode('&',$q1);
	    while (list(, $pair1) = each($pairs1)) {
	    list($key1,$value1) = explode('=', $pair1);
            if($key1 !=  $_SESSION['selectedID'] && $key1 != "page")
			{
			  ?>
			   <input type="hidden" name = "<?php echo $key1;?>" value="<?php echo $value1;?>">
			  <?php
			}
	    }
	   ?>
	   
	    <select name = page class="textbox" onChange="document.pages.submit();">
       <?php for ($i=1; $i<=$num_pages; $i++) { ?>
         <option value="<?php echo $i;?>" <?php if($i == $current_page_number) echo "selected";?>><?php echo $i ?></option> 
       <?php } ?>
	   </select>&nbsp;
	   <font  color="000000"><?php echo " of " . " " . $num_pages;?></font>
	    <?php  if (($current_page_number < $num_pages) && ($num_pages != 1)) { ?>
          <a href="<?php echo basename($_SERVER['PHP_SELF'])?>?page=<?php echo $current_page_number + 1?><?php if($qstring != "") {?>&<?php echo $qstring ?><?php }?>"> <font color="000000"> <?php echo PREVNEXT_BUTTON_NEXT ; ?></font></a>
	   <?php } else { ?>
           <font  color="000000"> <?php echo PREVNEXT_BUTTON_NEXT ; ?></font>&nbsp;&nbsp;&nbsp;<?php
        } ?>
	    </form>
	   <?php
      } else {
        $display_links = sprintf(TEXT_RESULT_PAGE, $num_pages, $num_pages);
      }


     }



 function display_links1($query_numrows, $max_rows_per_page, $max_page_links, $current_page_number, $parameters = '', $page_name = 'page',$fontColor='#FFFFFF') {
 
 
		
	
      global $PHP_SELF;

      if ( tep_not_null($parameters) && (substr($parameters, -1) != '&') ) $parameters .= '&';

// calculate number of pages needing links
      $num_pages = ceil($query_numrows / $max_rows_per_page);
	  $q = $_SERVER['QUERY_STRING'];
	  $pairs = explode('&',$q);
	  $qstring = "";
	  while (list(, $pair) = each($pairs)) {
	    list($key,$value) = explode('=', $pair);
            if($key !=  $_SESSION['selectedID'] && $key != "page")
			{
			  if($qstring == "")
			     $qstring .= $key . "=" . $value;
			  else
			     $qstring .= "&" . $key . "=" . $value; 	 
			}
	  }		
	  if ($num_pages > 1) { ?> 
          <form name = "pages" method="get" action="<?php echo $_SERVER['PHP_SELF'];?>"> 
          <p class = lighth13>
	   <?php 	  
	   if ($current_page_number > 1) { ?>
          <a href="<?php echo basename($_SERVER['PHP_SELF'])?>?page=<?php echo $current_page_number - 1?><?php if($qstring != "") {?>&<?php echo $qstring ?><?php }?>" style="background:none"> <font color="000000"><?php echo PREVNEXT_BUTTON_PREV;?></font></a>
	   <?php } else { ?>
           <font color="000000"><?php  echo PREVNEXT_BUTTON_PREV ; ?></font><?php
        }  ?>
         <font color="000000"><?php echo "page  " ;?></font>
	   
	   <?php 
	    $q1 = $_SERVER['QUERY_STRING'];
	    $pairs1 = explode('&',$q1);
	    while (list(, $pair1) = each($pairs1)) {
	    list($key1,$value1) = explode('=', $pair1);
            if($key1 !=  $_SESSION['selectedID'] && $key1 != "page")
			{
			  ?>
			   <input type="hidden" name = "<?php echo $key1;?>" value="<?php echo $value1;?>">
			  <?php
			}
	    }
	   ?>
	   
	    <select name = page class="textbox" onChange="document.pages.submit();">
       <?php for ($i=1; $i<=$num_pages; $i++) { ?>
         <option value="<?php echo $i;?>" <?php if($i == $current_page_number) echo "selected";?>><?php echo $i ?></option> 
       <?php } ?>
	   </select>&nbsp;
	   <font  color="000000"><?php echo " of " . " " . $num_pages;?></font>
	    <?php  if (($current_page_number < $num_pages) && ($num_pages != 1)) { ?>
          <a href="<?php echo basename($_SERVER['PHP_SELF'])?>?page=<?php echo $current_page_number + 1?><?php if($qstring != "") {?>&<?php echo $qstring ?><?php }?>" style="background:none"> <font color="000000"> <?php echo PREVNEXT_BUTTON_NEXT ; ?></font></a>
	   <?php } else { ?>
           <font  color="000000"> <?php echo PREVNEXT_BUTTON_NEXT ; ?></font>&nbsp;&nbsp;&nbsp;<?php
        } ?>
	    </form>
	   <?php
      } else {
        $display_links = sprintf(TEXT_RESULT_PAGE, $num_pages, $num_pages);
      }


     
 }
    function display_count($query_numrows, $max_rows_per_page, $current_page_number, $text_output) {
      $to_num = ($max_rows_per_page * $current_page_number);
      if ($to_num > $query_numrows) $to_num = $query_numrows;
      $from_num = ($max_rows_per_page * ($current_page_number - 1));
      if ($to_num == 0) {
        $from_num = 0;
      } else {
        $from_num++;
      }
      ?> <p class="lighth13">   
      <?php return sprintf($text_output, $from_num, $to_num, $query_numrows);
    }
 }

	 
///////////////////////////////////////////////////////////////////
    function display_links($query_numrows, $max_rows_per_page, $max_page_links, $current_page_number, $parameters = '', $page_name = 'page')
	 {
	// echo "$current_page_number=".$current_page_number;exit;
	  global $PHP_SELF;
	  
      if (empty($current_page_number)) $current_page_number = 1;
      if ( tep_not_null($parameters) && (substr($parameters, -1) != '&') ) $parameters .= '&';

// calculate number of pages needing links
      $num_pages = ceil($query_numrows / $max_rows_per_page);
      $q = $_SERVER['QUERY_STRING'];
	  $pairs = explode('&',$q);
	  $qstring = "";
	  while (list(, $pair) = each($pairs)) {
	    list($key,$value) = explode('=', $pair);
            if($key !=  $_SESSION['selectedID'] && $key != "page")
			{
			  if($qstring == "")
			     $qstring .= $key . "=" . $value;
			  else
			     $qstring .= "&" . $key . "=" . $value; 	 
			}
	  }		
	  if ($num_pages > 1) { ?> 
          <form name ="pages" method="get" action="<?php echo $_SERVER['PHP_SELF'];?>"> 
          <p class = lighth13>
	   <?php 	    if ($current_page_number > 1) { ?>
          <a href="<?php echo basename($PHP_SELF)?>?<?php echo $qstring ?>&page=<?php echo $current_page_number - 1 ; ?>"> <font color="#000000"><?php echo PREVNEXT_BUTTON_PREV;?></font></a>
	   <?php } else { ?>
           <font color="#000000"><?php  echo PREVNEXT_BUTTON_PREV ; ?></font><?php
        } ?>
        <?php echo "page  " ;?>
	   
	   <?php 
	    $q1 = $_SERVER['QUERY_STRING'];
	    $pairs1 = explode('&',$q1);
	    while (list(, $pair1) = each($pairs1)) {
	    list($key1,$value1) = explode('=', $pair1);
            if($key1 !=  $_SESSION['selectedID'] && $key1 != "page")
			{
			  ?>
			   <input type="hidden" name = "<?php echo $key1;?>" value="<?php echo $value1;?>">
			  <?php
			}
	    }
	   ?>
	    <select name = page class="textbox" onChange="document.pages.submit();">
       <?php
	    for ($i=1; $i<=$num_pages; $i++)
		 {?>
         <option value="<?php echo $i;?>" <?php if($i == $current_page_number) echo "selected";?>><?php echo $i ?></option> 
       <?php } ?>
	   </select>&nbsp;
	   <font  color="#000000"><?php echo " of " . " " . $num_pages;?></font>
	    <?php  if (($current_page_number < $num_pages) && ($num_pages != 1))
		 { ?>
			  <a href="<?php echo basename($PHP_SELF)?>?<?php echo $qstring ?>&page=<?php echo $current_page_number + 1?>"> <font color="#000000"> <?php echo PREVNEXT_BUTTON_NEXT ; ?></font></a>
	   <?php }
	    else 
		{ ?>
           <font  color="#000000"> <?php echo PREVNEXT_BUTTON_NEXT ; ?></font>&nbsp;&nbsp;&nbsp;<?php
        } ?>
	    </form>
	   <?php
      } 
/*	  else 
	  {?>
        <p class="lighth13"> 
		<? return $display_links = sprintf(TEXT_RESULT_PAGE, $num_pages, $num_pages);
      }
*/ }

    function display_count($query_numrows, $max_rows_per_page, $current_page_number,$text_output)
	 {
      if (empty($current_page_number)) $current_page_number = 1;
	  $to_num = ($max_rows_per_page * $current_page_number);
      if ($to_num > $query_numrows) $to_num = $query_numrows;
      $from_num = ($max_rows_per_page * ($current_page_number - 1));
      if ($to_num == 0) {
        $from_num = 0;
		return;
      } else {
        $from_num++;
      }
      ?>
      
       <p class="lighth13">   
      <?php return sprintf($text_output, $from_num, $to_num, $query_numrows);
    }

?>
