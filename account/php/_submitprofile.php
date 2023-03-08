<?php
require_once('../php/account.php');
require_once('_editprofileform.php');

function _onProfileChanged($strName, $strPhone, $strAddress, $strWeb, $strSignature, $strStatus)
{
    $str = 'Profile Changed';
    $str .= '<br />Name: '.$strName; 
    $str .= '<br />Phone: '.$strPhone; 
    $str .= '<br />Address: '.$strAddress; 
    $str .= '<br />Web: '.$strWeb; 
    $str .= '<br />Signature: '.$strSignature; 
    $str .= '<br />Status: '.$strStatus; 
    trigger_error($str); 
}

function _onEdit($strMemberId)
{
	// Sanitize the POST values
	$strName = SqlCleanString($_POST['name']);
	$strPhone = SqlCleanString($_POST['phone']);
	$strAddress = SqlCleanString($_POST['address']);
	$strWeb = SqlCleanString($_POST['web']);
	$strSignature = SqlCleanString($_POST['signature']);

	if (!SqlUpdateProfile($strMemberId, $strName, $strPhone, $strAddress, $strWeb, $strSignature))
	{	
		return false;
	}

	$strStatus = SqlCleanString($_POST['status']);
	if (!SqlUpdateStatus($strMemberId, $strStatus))
	{    
		return false;
	}
	
	_onProfileChanged($strName, $strPhone, $strAddress, $strWeb, $strSignature, $strStatus);
	return true;
}

class _SubmitProfileAccount extends Account
{
    public function Process($strLoginId)
    {
		if (!$strLoginId)					return;
    	if (!isset($_POST['submit']))	return;

		$strSubmit = $_POST['submit'];
		if ($strSubmit == ACCOUNT_PROFILE_EDIT || $strSubmit == ACCOUNT_PROFILE_EDIT_CN)
		{	// edit profile
		    _onEdit($strLoginId);
		}
		unset($_POST['submit']);
		
		if ($strSubmit == ACCOUNT_PROFILE_EDIT)
		{
		    SwitchToLink('profile.php');
		}
		else if ($strSubmit == ACCOUNT_PROFILE_EDIT_CN)
		{
		    SwitchToLink('profilecn.php');
		}
	}
}

?>
