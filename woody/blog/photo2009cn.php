<?php 
require('php/_blogphoto.php');

function GetMetaDescription()
{
	return 'Woody的2009年网络日志中使用的图片列表和日志链接. 包括中国市场上最便宜的PSTN电话外壳, Palmmicro PA1688软件中被浪费了的1x16 SDRAM等.';
}

function EchoAll()
{
    echo <<<END
<p>9月27日 <a href="pa6488/20090927cn.php">从PA1688到PA6488 - 安全模式恢复</a>
<br /><img src=../../pa1688/user/g1681/back.jpg alt="Soyo G1681 (PA168V/AG-168V) 1-port FXS gateway back view." /></p>

<p>8月8日 <a href="pa6488/20090808cn.php">从PA1688到PA6488 - Ping的反应时间</a>
<br /><img src=../../pa1688/user/pb35/m12l16161a.jpg alt="ESMT 1Mx16-bit SDRAM chip on China Roby PB-35 IP phone inside PCB board." /></p>

<p>2月17日 <a href="ar1688/20090217cn.php">低成本电话</a>
<br /><img src=photo/20090217.jpg alt="the cheapest PSTN phone case in China market." /></p>
END;
}

require('/php/ui/_dispcn.php');
?>
