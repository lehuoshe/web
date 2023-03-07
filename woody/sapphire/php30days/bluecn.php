<?php
require('php/_php30days.php');

function GetTitle()
{
	return '林近岚满月艺术照 - 蓝色系列';
}

function GetMetaDescription()
{
	return '林近岚(英文名Sapphire)的满月艺术照. 蓝色系列. 2014年12月12号由深圳远东妇儿科医院馨月馆月子中心的专业摄影师拍摄和处理. 大家看看值多少钱, 我反正觉得超级不值!';
}

function EchoAll()
{
    echo <<<END
<p>白衣蓝帽. <a href="../30days/large/blue.jpg" target=_blank>放大</a>
<br /><img src=../30days/blue.jpg alt="Sapphire Lin dress in white and blue." /></p>

<p>半身照. <a href="../30days/large/blue2.jpg" target=_blank>放大</a>
<br /><img src=../30days/blue2.jpg alt="Sapphire Lin dress in blue and white, half view." /></p>

<p>全身照. <a href="../30days/large/blue3.jpg" target=_blank>放大</a>
<br /><img src=../30days/blue3.jpg alt="Sapphire Lin dress in blue, full view." /></p>

<p>打哈欠. <a href="../30days/large/blue4.jpg" target=_blank>放大</a>
<br /><img src=../30days/blue4.jpg alt="Sapphire Lin dress in blue, yawning." /></p>

<p>趴着. <a href="../30days/large/blue5.jpg" target=_blank>放大</a>
<br /><img src=../30days/blue5.jpg alt="Sapphire Lin dress in blue, sprawling." /></p>
END;
}

require('../../../php/ui/_dispcn.php');
?>
