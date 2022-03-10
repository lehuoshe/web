<?php require_once('php/_20151225.php'); ?>
<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
<title>新浪股票数据接口的字段意义</title>
<meta name="description" content="记录和分析新浪A股(http://hq.sinajs.cn/list=sz162411), 港股, 美股(http://hq.sinajs.cn/list=gb_xop), 期货和汇率等实时数据接口的字段意义.">
<?php EchoInsideHead(); ?>
<link href="../../../common/style.css" rel="stylesheet" type="text/css" />
</head>

<body bgproperties=fixed leftmargin=0 topmargin=0>
<?php _LayoutTopLeft(); ?>

<div>
<h1>新浪股票数据接口的字段意义</h1>
<p>2015年12月25日
<br />在<?php EchoXueqieId('2091843424', '塔夫男'); ?>等人的建议下, 最近打算加入<?php EchoNameLink('fundhistory', FUND_HISTORY_DISPLAY, '20150818cn.php'); ?>的表格.
开始动手后发现4个多月前分析的新浪A股实时数据接口的字段意义已经差不多忘光了. 好记性不如烂笔头, 本着磨刀不误砍柴工的精神, 先在这里完整记录一下, 以便日后查阅.
<br />目前从<?php EchoSinaQuotesLink('sz162411'); ?>拿到后记录在<?php EchoSinaDebugLink('sz162411'); ?>中的数据如下:
<br /><font color=gray>var hq_str_sz162411="华宝油气,
0.502,0.482,0.500,0.503,0.499,0.499,0.500,811593355,406232297.465,
31772194,0.499,4024600,0.498,771800,0.497,854000,0.496,308800,0.495,
6062158,0.500,47389213,0.501,11186263,0.502,13222780,0.503,4471351,0.504,
2015-12-24,15:34:34,00";</font>
<br />跟<?php EchoSinaStockLink('SZ162411'); ?>的显示数据比较, 去掉前后双引号后, 按逗号','分隔的各个字段意义如下表.
</p>
<?php
    EchoInterpretationParagraph(array(array('0', '华宝油气', '<a href="20101107cn.php">GB2312</a>编码的股票名字'),
                                   array('1', '0.502', STOCK_DISP_OPEN),
                                   array('2', '0.482', '昨日收盘价'),
                                   array('3', '0.500', '当前价格, 收盘后数据可以当成今日收盘价?'),
                                   array('4', '0.503', STOCK_DISP_HIGH),
                                   array('5', '0.499', STOCK_DISP_LOW),
                                   array('6', '0.499', '当前买价, 跟序号11买一字段相同.'),
                                   array('7', '0.500', '当前卖价, 跟序号21卖一字段相同.'),
                                   array('8', '811593355', '总成交的股数, 8115934手.'),
                                   array('9', '406232297.465', '总成交的金额, 40623万元.'),
                                   array('10', '31772194', '买一股数, 317721手.'),
                                   array('11', '0.499', '买一价格, 跟序号6相同.'),
                                   array('12-19', '4024600,0.498, 771800,0.497, 854000,0.496, 308800,0.495', '买二到买五的股数和价格'),
                                   array('20', '6062158', '卖一股数, 60622手.'),
                                   array('21', '0.500', '卖一价格, 跟序号7相同.'),
                                   array('22-29', '47389213,0.501, 11186263,0.502, 13222780,0.503, 4471351,0.504', '卖二到卖五的股数和价格'),
                                   array('30', '2015-12-24', '日期'),
                                   array('31', '15:34:34', '时间'),
                                   array('32', '00', '结束符?')
                                   ), 'stock');
?>

<h3>新浪外盘<a name="future">期货</a>实时数据接口的字段意义</h3>
<p>2016年1月28日
<br />最近在<?php EchoXueqieId('8907500725', 'oldwain'); ?>的建议下, 在<a href="../../res/sz162411cn.php">华宝油气</a>净值计算页面中相关价格记录的时间中加入日期显示.
这下上次的股票接口记录就派上用场了. 不过期货的格式又重新看了一遍, 加个记录以防以后还要用.
<br />目前从<?php EchoSinaQuotesLink('hf_CL'); ?>拿到后记录在<?php EchoSinaDebugLink('hf_cl'); ?>中的数据如下:
<br /><font color=gray>var hq_str_hf_CL="31.85,1.2719,31.85,31.86,31.88,30.14,
00:24:20,31.45,30.52,40629,0,0,2016-01-28,NYMEX原油";</font>
<br />去掉前后双引号后, 按逗号','分隔的各个字段意义如下表.
</p>
<?php
    EchoInterpretationParagraph(array(array('0', '31.85', '当前价格'),
                                   array('1', '1.2719', '相对上一日结算价的变化百分比'),
                                   array('2', '31.85', '当前买价'),
                                   array('3', '31.86', '当前卖价'),
                                   array('4', '31.88', STOCK_DISP_HIGH),
                                   array('5', '30.14', STOCK_DISP_LOW),
                                   array('6', '00:24:20', '时间'),
                                   array('7', '31.45', '上一日结算价格'),
                                   array('8', '30.52', STOCK_DISP_OPEN),
                                   array('9', '40629', '持仓量'),
                                   array('10', '0', '当前买量?'),
                                   array('11', '0', '当前卖量?'),
                                   array('12', '2016-01-28', '日期'),
                                   array('13', 'NYMEX原油', 'GB2312编码的名字')
                                   ), 'future');
?>

<h3>新浪<a name="fund">基金</a>数据接口的字段意义</h3>
<p>2016年2月16日
<br />晚上9点多的时候, <?php EchoXueqieId('5240589924', 'uqot'); ?>跟我说<a href="20150818cn.php">华宝油气净值</a>出问题了. 我看了一下调试信息, 发现8点的时候做了一次自动校准,
从<?php EchoSinaQuotesLink('f_162411'); ?>拿到后记录在<?php EchoSinaDebugLink('f_162411'); ?>中的数据如下:
<br /><font color=gray>var hq_str_f_162411="华宝兴业标普油气上游股票(QDII-LOF),
0.406,0.406,0.435,2016-02-15,66.2444";</font>
<br />按照php/<b>_qdii.php</b>中的自动校准流程, 拿到15号的SZ162411净值后先跟15号XOP的收盘值校准, 但是昨天美股因为总统日没有交易, 这一步没有成功.
接下来进入使用前一个交易日的数据校准的代码, 而不幸的是美股的上周5交易日刚好碰上中国春节假期, A股没有交易.
数据中的上一个交易日净值是春节前的, 于是软件拿节前最后一个交易日的华宝油气净值跟上周五XOP收盘价做了错误的自动校准. 这种bug只在中美轮流休市的情况下才会出现, 而过去的一周恰好是这种情况!
<br />我先用手工校准的功能恢复了正确的参数, 然后趁着又看了一遍基金数据的热乎劲, 加个记录以防以后还要用.
<br />去掉前后双引号后, 按逗号','分隔的各个字段意义如下表.
</p>
<?php
    EchoInterpretationParagraph(array(array('0', '华宝兴业标普油气上游股票(QDII-LOF)', 'GB2312编码的名字'),
                                   array('1', '0.406', '目前净值'),
                                   array('2', '0.406', '累计净值'),
                                   array('3', '0.435', '上一个交易日净值'),
                                   array('4', '2016-02-15', '日期'),
                                   array('5', '66.2444', '(未知)')
                                   ), 'fund');
?>

<h3>新浪<a name="hongkong">港股</a>数据接口的字段意义</h3>
<p>2016年3月2日
<br />用Yahoo拿港股数据搞了大半年后, 一贯后知后觉的我才发现新浪也有港股数据. 这次吸取以往教训, 挽起袖子改程序前先写这个格式文档, 然后再改我的<font color=olive>StockReference</font>类.
从<?php EchoSinaQuotesLink('hk02828'); ?>拿到的数据如下:
<br /><font color=gray>var hq_str_hk02828="HS H-SHARE ETF,恒生Ｈ股,
83.100,81.250,85.100,83.100,84.350,3.100,3.815,84.450,84.500,1659103503,19690659,
0.000,0.000,151.200,75.700,2016/03/02,16:01";</font>
<br />跟<?php EchoSinaStockLink('02828'); ?>的显示数据比较, 去掉前后双引号后, 按逗号','分隔的各个字段意义如下表.
</p>
<?php
    EchoInterpretationParagraph(array(array('0', 'HS H-SHARE ETF', '英文名字'),
                            array('1', '恒生Ｈ股', 'GB2312编码的中文名字'),
                            array('2', '83.100', STOCK_DISP_OPEN),
                            array('3', '81.250', '昨日收盘价'),
                            array('4', '85.100', STOCK_DISP_HIGH),
                            array('5', '83.100', STOCK_DISP_LOW),
                            array('6', '84.350', '当前价格, 收盘后数据可以当成今日收盘价?'),
                            array('7', '3.100', '相对昨日收盘价的变化'),
                            array('8', '3.815', '相对昨日收盘价的变化百分比'),
                            array('9', '84.450', '当前买价?'),
                            array('10', '84.500', '当前卖价?'),
                            array('11', '1659103503', '总成交的金额, 16.591亿.'),
                            array('12', '19690659', '总成交的股数, 1969.066万股.'),
                            array('13', '0.000', '市盈率?'),
                            array('14', '0.000', '周息率?'),
                            array('15', '151.200', '52周'.STOCK_DISP_HIGH),
                            array('16', '75.700', '52周'.STOCK_DISP_LOW),
                            array('17', '2016/03/02', '日期'),
                            array('18', '16:01', '时间')
                            ), 'hkstock');
?>

<h3>新浪<a name="futurecn">国内期货</a>实时数据接口的字段意义</h3>
<p>2016年10月8日
<br />国际黄金价格在国庆期间暴跌, 赶快把黄金基金估值重新整理一下.
<br />目前从<?php EchoSinaQuotesLink('AU0'); ?>拿到后记录在<?php EchoSinaDebugLink('au0'); ?>中的数据如下:
<br /><font color=gray>var hq_str_AU0="黄金连续,145957,283.90,285.55,283.90,284.75,285.25,285.30,285.30,284.75,
285.20,31,38,292310,125074,沪,黄金,2016-09-30,0,289.300,
283.900,289.700,283.050,291.700,282.000,293.500,282.000,2.280";
</font>
<br />跟<?php EchoSinaFutureLink('AU0'); ?>的显示数据比较, 去掉前后双引号后, 按逗号','分隔的各个字段意义如下表.
</p>
<?php
    EchoInterpretationParagraph(array(array('0', '黄金连续', '名字'),
                                   array('1', '145957', '时间14:59:57'),
                                   array('2', '283.90', STOCK_DISP_OPEN),
                                   array('3', '285.55', STOCK_DISP_HIGH),
                                   array('4', '283.90', STOCK_DISP_LOW),
                                   array('5', '284.75', '昨日收盘价'),
                                   array('6', '285.25', '买价'),
                                   array('7', '285.30', '卖价'),
                                   array('8', '285.30', '最新价'),
                                   array('9', '284.75', '结算价'),
                                   array('10', '285.20', '昨结算'),
                                   array('11', '31', '买量'),
                                   array('12', '38', '卖量'),
                                   array('13', '292310', '持仓量'),
                                   array('14', '125074', STOCK_DISP_QUANTITY),
                                   array('15', '沪', '商品交易所简称'),
                                   array('16', '黄金', '品种名简称'),
                                   array('17', '2016-09-30', '日期'),
                                   array('18-27', '0, 289.300, 283.900, 289.700, 283.050, 291.700, 282.000, 293.500, 282.000, 2.280', '(未知)')
                                   ), 'cnfuture');
?>

<h3>新浪实时<a name="stockus">美股</a>数据接口的字段意义</h3>
<p>2016年10月17日
<br />最近在<a href="20141016cn.php">股票</a>交易中对均线的依赖越来越严重, 而同时Yahoo的负面用户体验和甩卖消息越来越多, 让我比较担心哪一天Yahoo突然不提供历史数据了, 毕竟是一个非公开的东西.
于是下决心自己开始记录历史数据, 刚开始改程序就发现去年底写的读取新浪实时美股数据的代码中缺Yahoo历史数据中提供的的开盘价, 最高价, 最低价和成交量. 又要重新开始看数据接口的字段意义.
从<?php EchoSinaQuotesLink('gb_xop'); ?>拿到后记录在<?php EchoSinaDebugLink('gb_xop'); ?>中的数据如下:
<br /><font color=gray>var hq_str_gb_xop="油气开采指数ETF-SPDR S&P,37.66,-1.08,2016-10-15 08:18:14,-0.41,
38.07,38.36,37.55,40.28,22.06,
15291967,15204095,523473999,8.36,4.50,
0.00,1.43,0.54,0.72,13900000,
0.00,37.70,0.11,0.04,Oct 14 08:00PM EDT,
Oct 14 04:00PM EDT,38.07,106590.00";
</font>
<br />跟<?php EchoSinaStockLink('XOP'); ?>的显示数据比较, 去掉前后双引号后, 按逗号','分隔的各个字段意义如下表.
</p>
<?php
    EchoInterpretationParagraph(array(array('0', '油气开采指数ETF-SPDR S&P', 'GB2312编码的中文名字'),
                            array('1', '37.66', '当前价格, 收盘后数据可以当成今日收盘价?'),
                            array('2', '-1.08', '相对昨日收盘价的变化百分比'),
                            array('3', '2016-10-15 08:18:14', '中国时区日期和时间'),
                            array('4', '-0.41', '相对昨日收盘价的变化'),
                            array('5', '38.07', STOCK_DISP_OPEN),
                            array('6', '38.36', STOCK_DISP_HIGH),
                            array('7', '37.55', STOCK_DISP_LOW),
                            array('8', '40.28', '52周'.STOCK_DISP_HIGH),
                            array('9', '22.06', '52周'.STOCK_DISP_LOW),
                            array('10', '15291967', STOCK_DISP_QUANTITY),
                            array('11', '15204095', '10日均量'),
                            array('12', '523473999', '市值'),
                            array('13', '8.36', '每股收益'),
                            array('14', '4.50', '市盈率'),
                            array('15', '0.00', '(未知)'),
                            array('16', '1.43', '贝塔系数'),
                            array('17', '0.54', '股息'),
                            array('18', '0.72', '收益率'),
                            array('19', '13900000', '股本'),
                            array('20', '0.00', '(未知)'),
                            array('21', '37.70', '盘前盘后交易'),
                            array('22', '0.11', '盘前盘后交易变化百分比'),
                            array('23', '0.04', '盘前盘后交易变化'),
                            array('24', 'Oct 14 08:00PM EDT', '美东时区盘前盘后交易日期和时间'),
                            array('25', 'Oct 14 04:00PM EDT', '美东时区日期和时间'),
                            array('26', '38.07', '昨日收盘价'),
                            array('27', '106590.00', '盘前盘后交易'.STOCK_DISP_QUANTITY),
                            array('28', '1', '(未知, 从此项开始以下为2020年9月22日新增)'),
                            array('29', '2020', '年份, 可能是为了24和25项在年末时用strtotime函数会搞错年份而加.'),
                            array('30', '201888349.000000', '当日成交金额, 除以第10项换算成当日均价后跟雪球显示的不一致.'),
                            ), 'usstock');
?>

</div>

<?php _LayoutBottom(); ?>

</body>
</html>
