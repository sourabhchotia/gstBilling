<?php require_once('include/config.php');
	$reffer=$_SERVER['HTTP_REFERER'];
	$time=time();
	if(isset($_POST['submit'])){
		$suxes=1;
		$empty=0;
		foreach($_POST as $key=>$value)
		{
			if($value=='') $empty=1;
		} 
		if($empty)
		{
			$suxes=0;
			$_SESSION['MSG']="Fill all the Field!"; 
			header("location:".$reffer); 
			exit;
		}
 		$adminSql=$db->query("SELECT * FROM ".TABLE_ADMIN." WHERE username='".trim($_POST['username'])."' AND password ='".($_POST['password'])."' AND status='A'");

 		if($db->numRows($adminSql))
		{ 
			$admRow=$db->fetchNextObject($adminSql);
			$db->query("UPDATE ".TABLE_ADMIN." SET lastlogin='$time' WHERE admin_id='".$admRow->admin_id."'");
 			$_SESSION['fname']=$admRow->fname;
			$_SESSION['lname']=$admRow->lname;
			$_SESSION['lastLogin']=$admRow->lastlogin;
			$_SESSION['loginID']=$admRow->admin_id;
			redirect('index.php');
		}
		else
		{
		 	$_SESSION['MSG']="ERROR: Login Attemppt Failed!";  
			redirect($reffer);
		}
	}	
?>