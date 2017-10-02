<?php ob_start();

/*************************** Replace of print_r ******************************************/
function preint_r($array)
{
	echo "<pre>";
	print_r($array);
	echo "</pre>";
}
/*************************** Encode Decode Function ******************************************/
function encode($val){
	return base64_encode($val);	
}

function decode($dVal){
	return base64_decode($dVal);
}


/*********************** To remove slashes and html tags of input**************************************/

function mysqlString($string){
	$val=strip_tags(mysql_real_escape_string(stripslashes($string)));
return 	$val;
}
function sanitize($var, $santype = 1){
	if ($santype == 1) {return strip_tags($var);}
	if ($santype == 2) {return htmlentities(strip_tags($var),ENT_QUOTES,'UTF-8');}
	if ($santype == 3) 
	{
		if (!get_magic_quotes_gpc()) {
			return addslashes(htmlentities(strip_tags($var),ENT_QUOTES,'UTF-8'));
		} 
		else {
		   return htmlentities(strip_tags($var),ENT_QUOTES,'UTF-8');
		}
	}
}
	
	
function sanitize_input($input,$escape_mysql=false,$sanitize_html=true,
						   $sanitize_special_chars=true,$allowable_tags='<br><b><strong><p>')
{
		unset($input['submit']); //we use 'submit' variable for all of our form
				
		$input_array = $input;
		
		//array is not referenced when passed into foreach
		//this is why we create another exact array
		foreach ($input as $key=>$value)
		{
			if(!empty($value))
			{ 
				//$input_array[$key]=strtolower($input_array[$key]);
				//stripslashes added by magic quotes
				if(get_magic_quotes_gpc()){$input_array[$key]=sanitize($input_array[$key]);}	
				
				if($sanitize_html){$input_array[$key] = strip_tags($input_array[$key],$allowable_tags);}
				
				if($sanitize_special_chars){$input_array[$key] = htmlspecialchars($input_array[$key]);}				
				
				if($escape_mysql){$input_array[$key] = mysql_real_escape_string($input_array[$key]);}
			}
		}
		
		return $input_array;
	
}



/*************************** Check Session For Admin - Function Start ******************************************/

function check_session()
{
	if($_SESSION['adminLogin']!="true")
	{
		header("location:".ADMIN);
		exit;
	}
}

/*************************** Check Session For CSR - Function Start ******************************************/

function check_session1()
{
	if(!isset($_SESSION["userId"]) && $_SESSION["userId"]=="")
	{
		header("location:".WEB."login.php");
		exit;
	}
}

/*************************** Check Session For CSR - Function End   ******************************************/


function getPage()
{	
	
	global	$db;
	global	$mySession;
	
	if(isset($_REQUEST['go'])&&($_REQUEST['go']!="")){
	$page=$_REQUEST['go'];
	}
	
	if(isset($page))
	{
	 $pageToCall = $page.".php";
	 
	if (file_exists($pageToCall)) {
    
     } else {
    $pageToCall = "error.php";
     }
	}
	else
	$pageToCall = "error.php";
	
	$success = include_once($pageToCall);
	
	return $success;
}

/********************************************* PHP_SELP ************************************************************/

function GET_PAGE_URL()
{
	$URL	=	"http://";
	$URL	.=	$_SERVER['HTTP_HOST'];
	$URL	.=	$_SERVER['PHP_SELF'];
	if($_SERVER['QUERY_STRING'])
	$URL	.=	"?".$_SERVER['QUERY_STRING'];
	return $URL;
}

/********************************************* getval **************************************************************/

function getVal($key = "",$secured = 0)	
{
	$outVal="";
	if($key == "")
		return;
	
	if($_SERVER['REQUEST_METHOD'] == "GET")//1
	 {
		if(array_key_exists($key,$_GET))
		{
			if(strlen(trim($_GET[$key]))>0)//2
			{	
				if($secured == 1)//3
				{
					if (get_magic_quotes_gpc()==1)//4
						$outVal = $_GET[$key];
					else
						$outVal = addslashes($_GET[$key]);
				}//3
				else
				{
				$outVal = $_GET[$key];
				}
			}//2
			else
			{
				$outVal = "";
			}
		 }	
	 }
	else
	{
		if(array_key_exists($key,$_POST))
		{
			if(@strlen(trim($_POST[$key]))>0)//2
			{	
				if($secured == 1)//3
				{
					if (get_magic_quotes_gpc()==1)//4
						$outVal = $_POST[$key];
					else
						$outVal = addslashes($_POST[$key]);
				}//3
				else
				{
				$outVal = $_POST[$key];
				}
			}//2
			else
			{
				$outVal = "";
			}
		}
	}
	return $outVal;
}

/****************************************************************************************************************/
function strTruncate($string, $length = 80, $etc = '...',
                                  $break_words = false, $middle = false)
{
    if ($length == 0)
        return '';

    if (strlen($string) > $length) {
        $length -= min($length, strlen($etc));
        if (!$break_words && !$middle) {
            $string = preg_replace('/\s+?(\S+)?$/', '', substr($string, 0, $length+1));
        }
        if(!$middle) {
            return substr($string, 0, $length) . $etc;
        } else {
            return substr($string, 0, $length/2) . $etc . substr($string, -$length/2);
        }
    } else {
        return $string. $etc;
    }
}
/***********************************************************************************************************************/
/*function getCustomFields($ReasonId="")
 {
	global $db;
	$condition="";
	if($ReasonId!=""){
	$condition	= " AND ReasonId=".$ReasonId;}
	$sql	=	"SELECT * FROM ".CUSTOMFIELD." WHERE 1 ".$condition." ";
	$query	=	$db->query($sql);
		
	return $query;	
}
*/



/****************************************************************************************************************/
function PHP_MAILLER( $TO, $CC, $FROM, $FROM_NAME, $REPLY_TO, $SUBJECT, $BODY, $ATTATCHMENT, $IS_HTML, $ALTERNET_BODY) 
{	
	include_once("classes/class.phpmailer.php");
	$mail = new PHPMailer();
	//$mail->IsMail();                                    
	//$mail->IsQmail();                                    
	//echo  $TO."-". $CC."-". $FROM."-". $FROM_NAME."-". $REPLY_TO."-". $SUBJECT."-". $BODY."-". $ATTATCHMENT."-". $IS_HTML."-". $ALTERNET_BODY;exit;
	$mail->From 	= $FROM;
	$mail->FromName = $FROM_NAME;
	$mail->AddAddress($TO);
	if( trim($CC) != "" ) 
	$mail->AddAddress($CC);
	$mail->AddReplyTo($REPLY_TO);
	
	if(trim($ATTATCHMENT) != "")
	for( $ii=0; $ii<count($ATTATCHMENT); $ii++)
	$mail->AddAttachment($ATTATCHMENT['rootPath'][$ii], $ATTATCHMENT['displayName'][$ii]);
	
	$mail->IsHTML($IS_HTML);                        // HTML [ TRUE/FALSE]
	$mail->Subject = $SUBJECT;
	$mail->Body    = $BODY;
	$mail->AltBody = $ALTERNET_BODY;
	
	if($mail->Send())
	{ //echo 1; exit;
	
	return true; 
	}
	else
	{
	
	return false;
	}
}

function validate_email($email) {
	$at = strrpos ( $email, "@" );
	
	// Make sure the at (@) sybmol exists and  
	// it is not the first or last character
	if ($at && ($at < 1 || ($at + 1) == strlen ( $email ))) {
		return false;
	}
	// Make sure there aren't multiple periods together
	if (preg_match ( "/(\.{2,})/", $email )) {
		return false;
	}
	// Break up the local and domain portions
	$local = substr ( $email, 0, $at );
	$domain = substr ( $email, $at + 1 );
	
	// Check lengths
	$locLen = strlen ( $local );
	$domLen = strlen ( $domain );
	if ($locLen < 1 || $locLen > 64 || $domLen < 4 || $domLen > 255) {
		return false;
	}
	// Make sure local and domain don't start with or end with a period
	if (preg_match ( "/(^\.|\.$)/", $local ) || preg_match ( "/(^\.|\.$)/", $domain )) {
		return false;
	}
	// Check for quoted-string addresses
	// Since almost anything is allowed in a quoted-string address,
	// we're just going to let them go through
	if (! preg_match ( '/^"(.+)"$/', $local )) {
		// It's a dot-string address...check for valid characters
		if (! preg_match ( '/^[-a-zA-Z0-9!#$%*\/?|^{}`~&\'+=_\.]*$/', $local ))
			return false;
	}
	
	// Make sure domain contains only valid characters and at least one period
	if (! preg_match ( "/^[-a-zA-Z0-9\.]*$/", $domain ) || ! strpos ( $domain, "." )) {
		return false;
	}
	return true;
}


function wordLimiter($data,$len)
{
    $data = trim($data);
    $data = explode(" ",$data);
    $stringLen =  count($data);
    if($stringLen <= $len)
    {
        $newData = implode(" ",$data);
        return $newData; 
    }
    else
    {
        for($i=0;$i<$len;$i++)
        {
            $newData.=$data[$i]." ";
        }
        return $newData."..."; 
    }              
    
}

#######################################OTHER FUNCTION FOR MYSQL QUERY#################################################################3
function tep_db_query($query) {

    if (defined('STORE_DB_TRANSACTIONS') && (STORE_DB_TRANSACTIONS == 'true')) {
      error_log('QUERY ' . $query . "\n", 3, STORE_PAGE_PARSE_TIME_LOG);
    }

    $result = mysql_query($query) or tep_db_error($query, mysql_errno(), mysql_error());

    if (defined('STORE_DB_TRANSACTIONS') && (STORE_DB_TRANSACTIONS == 'true')) {
       $result_error = mysql_error();
       error_log('RESULT ' . $result . ' ' . $result_error . "\n", 3, STORE_PAGE_PARSE_TIME_LOG);
    }

    return $result;
  }
  
  function tep_db_error($query, $errno, $error) { 
    die('<font color="#000000"><b>' . $errno . ' - ' . $error . '<br><br>' . $query . '<br><br><small><font color="#ff0000">[TEP STOP]</font></small><br><br></b></font>');
  }

function tep_db_fetch_array($db_query) {
    return mysql_fetch_array($db_query);
  }
  
  function tep_not_null($value) {
    if (is_array($value)) {
      if (sizeof($value) > 0) {
        return true;
      } else {
        return false;
      }
    } else {
      if ( (is_string($value) || is_int($value)) && ($value != '') && ($value != 'NULL') && (strlen(trim($value)) > 0)) {
        return true;
      } else {
        return false;
      }
    }
  }
	function redirect($site) 
	  {
		 header("location:".$site);
		 exit();
	   }
   function getCurrDate()
  {
      return strftime("%Y-%m-%d %H:%M:%S");  
  }
  function tep_db_insert_id() {
    return mysql_insert_id();
  }
function redirectTo($url)
{?>
<script type="text/javascript">
window.location = "<?php echo $url; ?>"
</script>
<?php 
}
?>