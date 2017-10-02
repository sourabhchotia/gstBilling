<?php ob_start();
if(isset($_GET['c']) && $_GET['c']!='' ){
	switch($_GET['c']){
		////   Admin File 
		case CON_HOME :{
	   	 	require_once(FILE_HOME); break;
	  	}
		
		case CON_LOGOUT :{
	 	   require_once(FILE_LOGOUT);  break;
	 	}
		
		case CON_VIEW_PROFILE :{
	 	   require_once(FILE_VIEW_PROFILE);  break;
	 	}
		
		case CON_CHANGE_PASS :{
	 	   require_once(FILE_CHANGE_PASS);  break;
	 	}
		
		
		
		
		
		
		case CON_CLIENT_MGMT :{
	 	   require_once(FILE_CLIENT_MGMT);  break;
	 	}
		
		case CON_ADD_CLIENT :{
	 	   require_once(FILE_ADD_CLIENT);  break;
	 	}
		
		case CON_VIEW_CLIENT_DETAIL :{
	 	   require_once(FILE_VIEW_CLIENT_DETAIL);  break;
	 	}
		
		case CON_VAT_MGMT :{
	 	   require_once(FILE_VAT_MGMT);  break;
	 	}
		
		case CON_ADD_VAT :{
	 	   require_once(FILE_ADD_VAT);  break;
	 	}
		
		case CON_VIEW_VAT_DETAIL :{
	 	   require_once(FILE_VIEW_VAT_DETAIL);  break;
	 	}
		
		
		
		
		
		
		
		
		case CON_TIN_SALES_BILLING :{
	 	   require_once(FILE_TIN_SALES_BILLING);  break;
	 	}
		
		case CON_DIRECT_LOCAL_BILLING :{
	 	   require_once(FILE_DIRECT_LOCAL_BILLING);  break;
	 	}
		
		
		
		
		
		
		
		case CON_LOCAL_BILL_STATEMENT :{
	 	   require_once(FILE_LOCAL_BILL_STATEMENT);  break;
	 	}
		
		case CON_SALES_STATEMENT :{
	 	   require_once(FILE_SALES_STATEMENT);  break;
	 	}
		
		
		
		
		
		case CON_FIND_BILL :{
	 	   require_once(FILE_FIND_BILL);  break;
	 	}
		
		case CON_FIND_BILL_DETAIL :{
	 	   require_once(FILE_FIND_BILL_DETAIL);  break;
	 	}
		
		case CON_GEN_FIND_BILL_DETAIL :{
	 	   require_once(FILE_GEN_FIND_BILL_DETAIL);  break;
	 	}
		
		
		
		
		default :{
			header("location:".FILE_INDEX); 
	   		break;
	 	 }	
	}
}
else
{
require_once(FILE_HOME);
}
?>