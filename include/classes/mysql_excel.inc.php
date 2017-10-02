<?php


     /*
     ###############################################
     ####                                       ####
     ####    Author : Harish Chauhan            ####
     ####    Date   : 31 Dec,2004               ####
     ####    Updated:                           ####
     ####                                       ####
     ###############################################

     */


	require("db.inc.php");
	require("excelwriter.inc.php");
	
	Class HarImport
	{
		var $db=null;
		var $error=""; //String
		function HarImport()
		{
							
		}
		/*
		* @Params
		* 		$host : Host name of mysql database
		* 		$user : User
		* 		$pwd  : Password
		* 		$databse : database name
		*/
		function openDatabase($host,$user,$pwd,$database)
		{
			$this->db=new DB();
			$this->db->open($host,$user,$pwd,$database);
			if(!$this->db)
			{
				$this->error=$this->db->error();
				return false;
			}
		}
		/*
		* @Params 
		* 		$tnlName=Name of table from the data is imported to excel file
		* 		$fileName=Name of the file wants to save as.On leaving balnk it takes the table name as file name
		* 		$download=Boolean value whether you wants to save on disk or you want to force to download the file.
		*/ 
		function ImportDataFromTable($tblName,$fileName="",$download=false)
		{
			if(empty($fileName))
				$fileName=$tblName.".xls";
			$sql="SELECT * FROM $tblName";
			return $this->ImportData($sql,$fileName,$download);
		}
		/*
		* @Params 
		* 		$sql=A valid SQL query.
		* 		$fileName=Name of the file wants to save as.On leaving balnk it takes the table name as file name
		* 		$download=Boolean value whether you wants to save on disk or you want to force to download the file.
		*/ 
		function ImportData($sql,$fileName="har_excel.xls",$download=false)
		{
			$excel=new ExcelWriter($fileName);
			if($excel==false)
			{
				$this->error=$excel->error;
				return false;		
			}

			$this->db->query($sql);
			if($this->db->numRows()==0)			
			{
				$this->error="No data found in the table";
				return false;
			}
			if($row=$this->db->fetchAssoc())
			{
				for($i=0;$i<count($row);$i++)
				{
					$fields[]=$this->db->fieldName($i);
				}
				$excel->writeLine($fields);
			
				do
				{
					$excel->writeLine($row);
				}while($row=$this->db->fetchAssoc());
			}
			$excel->close();
			$this->db->close();
			if($download)
			{
				if(!headers_sent())
					$this->download_file($fileName,true);
				else
				{
					$this->error="Error :Headers already Sent.Can't Download file.";
				}
			}
			return;
		}

		function download_file($filename,$isDel=false)
		{
			$file=basename($filename);
			
			if (strstr($_SERVER['HTTP_USER_AGENT'], "MSIE"))
			{
				$file = preg_replace('/\./', '%2e', $file, substr_count($file, '.') - 1);
			}

			// make sure the file exists before sending headers
			if(!$fdl=@fopen($filename,'r'))
			{
			   die("<br>Cannot Open File!<br>");
			}
			else
			{
			  header("Cache-Control: ");// leave blank to avoid IE errors
			  header("Pragma: ");// leave blank to avoid IE errors
			  header("Content-type: application/octet-stream");
			  header("Content-Disposition: attachment; filename=\"$file\"");
			  header("Content-length:".(string)(filesize($filename)));
			   sleep(1);
			  fpassthru($fdl);
			}
			if($isDel)
			{
				@unlink($filename);
			}
		}

	}

?>