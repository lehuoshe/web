<?php 
require('php/_blogphoto.php');

function GetMetaDescription($bChinese)
{
	return 'Pictures from Woody 2008 blog. Including photo with Chi-Shin Wang and Tang Li in Half Moon Bay etc.';
}

function EchoAll($bChinese)
{
    echo <<<END
<p>Nov 24 <a href="ar1688/20081124.php">Micrel KSZ8842</a>
<br /><img src=../../pa1688/user/hop3003/rtl8305sb.jpg alt="RTL8305SB chip in HOP3003 IP phone."></p>

<p>Aug 6 <a href="pa1688/20080806.php">Non-Standard PA1688 Based Devices</a>
<br /><img src=../../pa1688/user/ke1000/1.jpg alt="Non-standard PA1688 based Koncept KE1000 IP phone front picture." /></p>

<p>July 29 <a href="ar1688/20080729.php">Router, PPPoE and DM9003</a>
<br /><img src=../../ar1688/user/gp1266/03.jpg alt="GP1266 IP phone POWER, LAN1 and LAN2 interface." /></p>

<p>June 15 <a href="ar1688/20080615.php">A Farewell to RTL8019AS</a>
<br /><img src=../../pa1688/user/pb35/rtl8019as.jpg alt="RTL8019AS chip on China Roby PB-35 IP phone inside PCB board." /></p>

<p>Mar 26 The History of <a href="palmmicro/20080326.php">Palmmicro</a>.com Domain
<br /><img src=../groupphoto/company/20070920.jpg alt="Chi-Shin Wang, Tang Li and me in Half Moon Bay." /></p>
END;
}

require('/php/ui/_disp.php');
?>
