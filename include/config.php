<?php 
//error_reporting(0);
session_start();
	
	define("SERVER","localhost");
	define("DBASE","gstBilling");
	define("USER","root");
	define("PASS","");
	
	// Get site path
	
	$site_path 								= $_SERVER["DOCUMENT_ROOT"]."/politic/";
    $root_site_path							= str_replace("include/", "", $site_path);
    $root_site_path_home					= str_replace("include/", "", $site_path);
    $img_site_path							= $root_site_path."images/"; 


define("PAGING","25");

	//==========All classes will palce here==========/
	include_once("database_tables.php");
	//include_once("classes/paging.php");
	include_once('classes/class.upload.php');
	include_once("classes/db.class.php");
	include_once('info_headings.php');
	include_once('classes/split_page_results.php');
	//include_once('classes/mysql_excel.inc.php');
	include_once("filenames.php");
	/**********************************************************/
	
	//******************* object creation ***********************//
	//$mySession		=	new Session();
	$db				=	new DB(DBASE, SERVER, USER, PASS);
	//$objLogin		=	new Login();
	/************************************************************/


	//**********All Functions will palce here**********/	
	include_once(dirname(__FILE__).'/functions.php');
	//*************************************************/
?>