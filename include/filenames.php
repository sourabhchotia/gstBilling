<?php ob_start();
	
	################################# file name for index.php###################################
    define('CON_INDEX', 'ind');
	define('FILE_INDEX', CON_INDEX . 'ex.php');
	
	################################# file name for home.php###################################
    define('CON_HOME', 'ho');
	define('FILE_HOME', CON_HOME . 'me.php');
	
	##########################file name for login.php##########################################
    define('CON_LOGIN', 'logi');
	define('FILE_LOGIN', CON_LOGIN . 'n.php');
	
	############################file name for logout.php########################################
	define('CON_LOGOUT', 'logo');
	define('FILE_LOGOUT', CON_LOGOUT . 'ut.php');
	
	############################file name for viewProfile.php########################################
	define('CON_VIEW_PROFILE', 'ofi');
	define('FILE_VIEW_PROFILE', 'viewPr'.CON_VIEW_PROFILE . 'le.php');
	
	############################file name for changepass.php########################################
	define('CON_CHANGE_PASS', 'gepa');
	define('FILE_CHANGE_PASS', 'chan'.CON_CHANGE_PASS . 'ss.php');
	
	############################file name for findBillDetail.php########################################
	define('CON_FIND_BILL_DETAIL', 'lDe');
	define('FILE_FIND_BILL_DETAIL', 'findBil'.CON_FIND_BILL_DETAIL . 'tail.php');
	
	############################file name for findBillGenerate.php########################################
	define('CON_GEN_FIND_BILL_DETAIL', 'ene');
	define('FILE_GEN_FIND_BILL_DETAIL', 'findBillG'.CON_GEN_FIND_BILL_DETAIL . 'rate.php');
	
	
	
	
	
	
	
	
	
	
	
	
	
	############################file name for clientMgmt.php########################################
	define('CON_CLIENT_MGMT', 'ntM');
	define('FILE_CLIENT_MGMT', 'clie'.CON_CLIENT_MGMT . 'gmt.php');
	
	############################file name for addClient.php########################################
	define('CON_ADD_CLIENT', 'ien');
	define('FILE_ADD_CLIENT', 'addCl'.CON_ADD_CLIENT . 't.php');
	
	############################file name for viewClientDetail.php########################################
	define('CON_VIEW_CLIENT_DETAIL', 'ntD');
	define('FILE_VIEW_CLIENT_DETAIL', 'viewClie'.CON_VIEW_CLIENT_DETAIL . 'etail.php');
	
	############################file name for vatMgmt.php########################################
	define('CON_VAT_MGMT', 'tMg');
	define('FILE_VAT_MGMT', 'va'.CON_VAT_MGMT . 'mt.php');
	
	############################file name for addVat.php########################################
	define('CON_ADD_VAT', 'dVa');
	define('FILE_ADD_VAT', 'ad'.CON_ADD_VAT . 't.php');
	
	############################file name for viewVatDetail.php########################################
	define('CON_VIEW_VAT_DETAIL', 'tDe');
	define('FILE_VIEW_VAT_DETAIL', 'viewVa'.CON_VIEW_VAT_DETAIL . 'tail.php');
	
	
	
	
	
	
	
	
	
	
	
	
	############################file name for tinSalesBilling.php########################################
	define('CON_TIN_SALES_BILLING', 'esBi');
	define('FILE_TIN_SALES_BILLING', 'tinSal'.CON_TIN_SALES_BILLING . 'lling.php');
	
	############################file name for tinPurchseBilling.php########################################
	define('CON_TIN_PURCHASE_BILLING', 'seBi');
	define('FILE_TIN_PURCHASE_BILLING', 'tinPurcha'.CON_TIN_PURCHASE_BILLING . 'lling.php');
	
	############################file name for tinSRBilling.php########################################
	define('CON_TIN_SR_BILLING', 'RBi');
	define('FILE_TIN_SR_BILLING', 'tinP'.CON_TIN_SR_BILLING . 'lling.php');
	
	############################file name for tinPRBilling.php########################################
	define('CON_TIN_PR_BILLING', 'Bi');
	define('FILE_TIN_PR_BILLING', 'tinSR'.CON_TIN_PR_BILLING . 'lling.php');
	
	############################file name for directLocalBilling.php########################################
	define('CON_DIRECT_LOCAL_BILLING', 'alBi');
	define('FILE_DIRECT_LOCAL_BILLING', 'directLoc'.CON_DIRECT_LOCAL_BILLING . 'lling.php');
	
	############################file name for tinGenerateSalesBill.php########################################
	define('CON_TIN_GEN_SALES_BILLING', 'alesB');
	define('FILE_TIN_GEN_SALES_BILLING', 'tinGenerateS'.CON_TIN_GEN_SALES_BILLING . 'ill.php');
	
	############################file name for tinGenerateSRBill.php########################################
	define('CON_TIN_GEN_SR_BILLING', 'RB');
	define('FILE_TIN_GEN_SR_BILLING', 'tinGenerateS'.CON_TIN_GEN_SR_BILLING . 'ill.php');
	
	############################file name for generateLocalBill.php########################################
	define('CON_GEN_LOCAL_BILLING', 'calB');
	define('FILE_GEN_LOCAL_BILLING', 'generateLo'.CON_GEN_LOCAL_BILLING . 'ill.php');
	
	############################file name for tinBankCommission.php########################################
	define('CON_BANK_COMMISSION', 'mmis');
	define('FILE_BANK_COMMISSION', 'tinBankCo'.CON_BANK_COMMISSION . 'sion.php');
	
	############################file name for creditNote.php########################################
	define('CON_CREDIT_NOTE', 'tNo');
	define('FILE_CREDIT_NOTE', 'credi'.CON_CREDIT_NOTE . 'te.php');
	
	
	
	
	
	
	
	
	
	
	
	############################file name for tinAllStmt.php########################################
	define('CON_TIN_ALL_STATEMENT', 'llS');
	define('FILE_TIN_ALL_STATEMENT', 'tinA'.CON_TIN_ALL_STATEMENT . 'tmt.php');
	
	############################file name for tinGenerateAllStmt.php########################################
	define('CON_GEN_TIN_ALL_STATEMENT', 'ateAl');
	define('FILE_GEN_TIN_ALL_STATEMENT', 'tinGener'.CON_GEN_TIN_ALL_STATEMENT . 'lStmt.php');
	
	############################file name for creditNoteStmt.php########################################
	define('CON_CREDIT_NOTE_STATEMENT', 'teSt');
	define('FILE_CREDIT_NOTE_STATEMENT', 'creditNo'.CON_CREDIT_NOTE_STATEMENT . 'mt.php');
	
	############################file name for generateCreditNoteStmt.php########################################
	define('CON_GEN_CREDIT_NOTE_STATEMENT', 'dit');
	define('FILE_GEN_CREDIT_NOTE_STATEMENT', 'generateCre'.CON_GEN_CREDIT_NOTE_STATEMENT . 'NoteStmt.php');
	
	############################file name for localBillStmt.php########################################
	define('CON_LOCAL_BILL_STATEMENT', 'llSt');
	define('FILE_LOCAL_BILL_STATEMENT', 'localBi'.CON_LOCAL_BILL_STATEMENT . 'mt.php');
	
	############################file name for generateLocalBillStmt.php########################################
	define('CON_GEN_LOCAL_BILL_STATEMENT', 'alB');
	define('FILE_GEN_LOCAL_BILL_STATEMENT', 'generateLoc'.CON_GEN_LOCAL_BILL_STATEMENT . 'illStmt.php');
	
	############################file name for tinPurchaseStmt.php########################################
	define('CON_PURCHASE_STATEMENT', 'urc');
	define('FILE_PURCHASE_STATEMENT', 'tinP'.CON_PURCHASE_STATEMENT . 'haseStmt.php');
	
	############################file name for tinGeneratePurchaseStmt.php########################################
	define('CON_GEN_PURCHASE_STATEMENT', 'tePu');
	define('FILE_GEN_PURCHASE_STATEMENT', 'tinGenera'.CON_GEN_PURCHASE_STATEMENT . 'rchaseStmt.php');
	
	############################file name for tinSalesStmt.php########################################
	define('CON_SALES_STATEMENT', 'ale');
	define('FILE_SALES_STATEMENT', 'tinS'.CON_SALES_STATEMENT . 'sStmt.php');
	
	############################file name for tinGenerateSalesStmt.php########################################
	define('CON_GEN_SALES_STATEMENT', 'teSa');
	define('FILE_GEN_SALES_STATEMENT', 'tinGenera'.CON_GEN_SALES_STATEMENT . 'lesStmt.php');
	
	############################file name for tinPRStmt.php########################################
	define('CON_PR_STATEMENT', 'nP');
	define('FILE_PR_STATEMENT', 'ti'.CON_PR_STATEMENT . 'RStmt.php');
	
	############################file name for tinGeneratePRStmt.php########################################
	define('CON_GEN_PR_STATEMENT', 'tePR');
	define('FILE_GEN_PR_STATEMENT', 'tinGenera'.CON_GEN_PR_STATEMENT . 'Stmt.php');
	
	############################file name for tinSRStmt.php########################################
	define('CON_SR_STATEMENT', 'nS');
	define('FILE_SR_STATEMENT', 'ti'.CON_SR_STATEMENT . 'RStmt.php');
	
	############################file name for tinGenerateSRStmt.php########################################
	define('CON_GEN_SR_STATEMENT', 'teSR');
	define('FILE_GEN_SR_STATEMENT', 'tinGenera'.CON_GEN_SR_STATEMENT . 'Stmt.php');
	
	############################file name for findBill.php########################################
	define('CON_FIND_BILL', 'dBi');
	define('FILE_FIND_BILL', 'fin'.CON_FIND_BILL . 'll.php');
	
	############################file name for findDueBalance.php########################################
	define('CON_FIND_DUE_BALANCE', 'eBa');
	define('FILE_FIND_DUE_BALANCE', 'findDu'.CON_FIND_DUE_BALANCE . 'lance.php');
	
	
	
	
	
	
	
	
	
	
	
	
	############################file name for cashInMgmt.php########################################
	define('CON_CASH_IN', 'nMg');
	define('FILE_CASH_IN', 'cashI'.CON_CASH_IN . 'mt.php');
	
	############################file name for cashOutMgmt.php########################################
	define('CON_CASH_OUT', 'utM');
	define('FILE_CASH_OUT', 'cashO'.CON_CASH_OUT . 'gmt.php');
	
	############################file name for cashFlowStmt.php########################################
	define('CON_CASH_FLOW_STMT', 'owSt');
	define('FILE_CASH_FLOW_STMT', 'cashFl'.CON_CASH_FLOW_STMT . 'mt.php');
	
	############################file name for tinGenerateCashReceipt.php########################################
	define('CON_CASH_RECEIPT', 'shRe');
	define('FILE_CASH_RECEIPT', 'tinGenerateCa'.CON_CASH_RECEIPT . 'ceipt.php');
	
	############################file name for generateCashFlowStmt.php########################################
	define('CON_GEN_CASH_FLOW_STMT', 'shFl');
	define('FILE_GEN_CASH_FLOW_STMT', 'generateCa'.CON_GEN_CASH_FLOW_STMT . 'owStmt.php');
?>
	