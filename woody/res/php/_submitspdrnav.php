<?php
require_once('_stock.php');
require_once('_spdrnavxls.php');
require_once('_emptygroup.php');

    $acct = new SymbolAccount();
	if ($acct->IsAdmin())
	{
		$acct->Create();
	    if ($ref = $acct->GetRef())
	    {
	        DebugNavXlsStr($ref);
	    }
	}
	$acct->Back();
	
?>
