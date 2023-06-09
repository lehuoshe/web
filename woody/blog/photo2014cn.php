<?php 
require('php/_blogphoto.php');

function GetMetaDescription()
{
	return 'Woody的2014年网络日志中使用的图片列表和日志链接. 包括PA1688 eHOG单口FXS网关内部PCB, 10月16日中国A股股票持仓的抓屏图等.';
}

function EchoAll()
{
	$strSapphire = GetHtmlElement('12月4日 '.GetBlogLink(20141204).'的由来 '.ImgWorriedWoody());
	$strStock = GetHtmlElement('10月16日 从上证大型国有'.GetBlogLink(20141016).'获利 '.ImgPortfolio20141016());
	
    echo <<<END
$strSapphire
$strStock

<p>4月5日 <a href="pa1688/20140405cn.php">好的坏的和丑陋的</a>
<br /><img src=../../pa1688/user/ehog/pcb.jpg alt="PA1688 eHOG 1-port FXS gateway internal PCB." /></p>
END;
}

require('../../php/ui/_dispcn.php');
?>
