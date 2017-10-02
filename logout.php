<?php 	
require_once('include/config.php');
session_start();
session_destroy();
header("location:".FILE_LOGIN);	
?>