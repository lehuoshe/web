<?php

function _SwitchPage($strPage)
{
//	session_write_close();	// save before switch
	header($strPage);
	exit();
}

function SwitchToLink($strLink)
{
	_SwitchPage('location: '.$strLink);
}

function SwitchTo($strTitle)
{
	SwitchToLink($strTitle.UrlGetType());
}

function SwitchSetSess()
{
	$_SESSION['userurl'] = UrlGetCur();
}

function SwitchGetSess()
{
    if (isset($_SESSION['userurl'])) 
    { 
    	return $_SESSION['userurl'];
    }
    return false;
}

function SwitchToSess()
{
    if (isset($_SESSION['userurl'])) 
    { 
//        $url = $_SESSION['userurl']; 
//        echo "<meta http-equiv=\"refresh\" content=\"0.5;url=$url\">";  //0.5s后跳转 
		$strLink = $_SESSION['userurl'];
		unset($_SESSION['userurl']);
		SwitchToLink($strLink);
    }
    else
    {
    	DebugString('SwitchToSess lost ...');
    }
/*	if (isset($_SERVER["HTTP_REFERER"]))
	{
		SwitchToLink($_SERVER["HTTP_REFERER"]);
	}
*/
}


?>
