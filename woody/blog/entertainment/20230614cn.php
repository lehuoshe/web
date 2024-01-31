<?php
require_once('php/_entertainment.php');

function GetMetaDescription()
{
	return '用套利美元利息解释自从美元加息以来纳斯达克100期货和标普500期货一直在持续升水的原因，市场定价总是有效的。';
}

function EchoAll()
{
	$strSZ159501 = GetGroupStockLink('SZ159501', true);
	$strQqqFund = GetStockCategoryLink('qqqfund');
	$strSnowball = GetExternalLink(GetXueqiuWoodyUrl().'253207525', '雪球');
	$strFuturesPremium = GetBlogLink(20200424);
	$strImage = ImgCMENQ20230614();

	EchoBlogDate();
    echo <<<END
<br />随着{$strSZ159501}今天开始交易，场内{$strQqqFund}基金已经到了两只手都要数不过来的边缘，而其中一半都是今年新开的，可见其受欢迎的程度。
<br />这些基金的实时估值使用的是新浪数据中的期货NQ。新浪的期货数据总是提供所谓的主力合约，也就是说它可能会切换得较早。比如NQ的数据，新浪在前两天就切换到了九月到期的合约。最近一年来，每当这种时候总有人问，为什么实时估值高那么多？
<br />因为随着美元的加息，纳斯达克100和标普500的期货一直在持续升水。
$strImage
</p>
<p>这是在写之前尽我所能的截屏。芝商所的数据延迟十分钟，{$strSnowball}数据基本上是实时的。可以看出，6月16日结算的合约(14983)跟现货(十分钟前大约14980)比已经只有很少的升水，但是九月合约相对于六月有(15169/14983=1.012)大约1.2%的升水。十二月相对于九月也是同样1.2%的升水。
<br />大家都喜欢说期货反应预期，所以这个升水很容易被解读成群众相信美股永远涨，但是这是错误的。就像我在2020年写的原油{$strFuturesPremium}油轮运费的关系一样，升水反应的是套利者之间的博弈。
<br />具体来算一下。假如持有QQQ的多仓，可以把它换成三个月后的NQ合约。因为期货收不到分红，这样会损失掉过几天后大约每股五毛的分红，也就是0.014%。但是在5%的美元利息下，从QQQ中腾出来的现金在三个月中可以收1.25%的利息。当然，因为NQ合约也要占用大约3.4%的现金，这个利息应该调整为1.201%，扣除分红损失后收益为1.187%。
也就是说，如果NQ不升水，那么所有持有QQQ的都可以用NQ替代，然后每三个月多赚1.187%的利息。天下没有免费的午餐，套利者博弈的结果，就是NQ每三个月固定升水1.2%。
</p>
END;
}

require('../../../php/ui/_dispcn.php');
?>