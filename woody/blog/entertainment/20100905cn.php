<?php require_once('php/_entertainment.php'); ?>
<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
<title>我的第一个PHP程序</title>
<meta name="description" content="Palmmicro PA6488开发的副产品. 我的第一个PHP程序: 用户和网络日志评论的CRUD(Create创建/Retrieve读取/Update更新/Delete删除).">
<?php EchoInsideHead(); ?>
<link href="../../../common/style.css" rel="stylesheet" type="text/css" />
</head>

<body bgproperties=fixed leftmargin=0 topmargin=0>
<?php _LayoutTopLeft(); ?>

<div>
<h1>我的第一个PHP程序</h1>
<p>2010年9月5日
<br />第一次听到PHP是从一个<a href="../../../ar1688/indexcn.html">AR1688</a>开发者那里. 他告诉我他在网页界面中写了些PHP代码自动计算网页总字节大小, 这样可以避免AR1688网页界面因为超过大小限制而静悄悄的自动罢工.
不过我现在知道他有关PHP的部分并不正确, 也许他想说的是Javascript的代码. 
<br />隔了段时间, <a href="../../../res/translationcn.html#webhosting">Yahoo网站服务</a>提示我把这个网站从PHP4升级到PHP5. 这是第二次, 我意识到了PHP就在我身边. 
<br />两个月前我知道了一个做电子商务的创业公司, 询问他们用什么语言开发, 结果在答案中又听到了PHP. 当时我很高兴, 觉得自己之前已经听说过两次了, 应该对它不再是一无所知. 
<br />由于我已经有了这么多PHP知识, 当<a href="../../../pa6488/indexcn.html">PA6488</a>摄像头管理器软件<a href="../../../pa6488/software/cammancn.html">CamMan</a>需要用户管理功能的时候, 我马上开始了在公司网站的PHP开发.
现在用户已经可以注册帐号测试. 由于基于PA6488的摄像头还没有面世, 用户可以先在这个网络日志上测试评论功能. 只有注册用户才能发表评论. 
<br />这就是我的第一个PHP程序: 用户和网络日志评论的CRUD(Create创建/Retrieve读取/Update更新/Delete删除). 
<?php echo ImgPhpBest(); ?>
</p> 
<blockquote><font color=gray>女神: 你能让这个论坛的人都吵起来, 我今晚就跟你走. 
<br />程序猿: PHP语言是最好的语言!
<br />论坛炸锅了, 各种吵架. 
<br />女神: 服了你了, 我们走吧, 你想干啥都行. 
<br />程序猿: 今天不行, 我一定要说服他们, PHP语言是最好的语言. 
</font></blockquote>

<h3><?php EchoNameTag('primenumber', ACCOUNT_TOOL_PRIME_CN); ?></h3>
<p>2019年4月12日
<br />昨天是王小波忌日, 让我对自己的胸闷和牙疼症状充满了警惕. 最近整理<a href="20150818cn.php">华宝油气净值</a>的软件代码真有种死去活来的感觉, 经常让我怀疑自己到底在干什么.
今天看到这个图片, 我觉得自己该做点简单的东西恢复一下信心, 就削尖铅笔写了这个<?php EchoPrimeNumberLink(); ?>的工具.
<br /><img src=../photo/primenumber.jpg alt="The picture that encouraged me to write this prime nnumber tool." />
<br />分解质因数可以用最直接的方式实现, 对指定的数字n, 从2开始一个个反复除到n的平方根为止就行了. 下面用数字68举个具体的例子.
</p>
<ol>
  <li>68的平方根在8和9之间, 我们从2到8都除一遍就可以了. 68/2=34, 68=2*?.</li>
  <li>因为34还是偶数, 继续来除2. 34/2=17, 68=2*2*?.</li>
  <li>17不是3的整数倍数.</li>
  <li>17不是4的整数倍数. 这里可以看到, 虽然原来68是4的整数倍数, 但是我们已经在前面处理过了.</li>
  <li>对数字5来说, 因为5*5已经比17大, 我们不用继续除下去了, 最终结果就是68=2*2*17.</li>
</ol>
<p>接下来一个最直接的优化想法, 就是先把一定范围内的已知质数算出来, 这样我们在进行上面的计算时, 就不用算17是不是4的整数倍数了.
基于<a href="20101107cn.php">GB2312</a>大数组的教训, 我这次直接把前4972个质数存到了MySQL的表中. 不过结果让我很失望, 查MySQL已知质数表的结果反而要比直接算慢很多倍.
<br />当然还有像Pollard Rho这种效率更高的分解质因数算法, 不过看看这些有关质数的文章: <?php EchoExternalLink('https://taodaling.github.io/blog/2019/04/03/Pollard-Rho-%E5%9B%A0%E5%BC%8F%E5%88%86%E8%A7%A3/'); ?>
<br />是不是很容易觉得自己是数学白痴?
<br />不过我还是很积极的在php下新建了一个子目录tutorial, 把这个新文件<b>primenumber.php</b>放了进去. 
同时开始憧憬万一几年后我真的开始自己做软硬件课件教<a href="20141204cn.php">林近岚</a>编程序的话, 今天这些工作可以做为其中的一节软件课. 
<br /><font color=gray>做人要是没有梦想, 跟咸鱼有什么两样?</font>
</p>

<h3>UTF8的双字节空格字符</h3>
<p>2021年6月22日
<br />收到来自<a href="20150818cn.php#weixin">微信公众号</a>的通知邮件, 说有用户查询<font color=green>161116&nbsp;</font>没有找到匹配的信息后, 我简直不敢相信自己的眼睛.
<br />登录公众号管理系统后, 我把用户发送的内容复制到了微信PC版本的输入界面中, 显示除了161116外, 还额外换了2行, 果然这样发出去是会匹配失败的, 其中应该包含了我没想到过的未知字符.
<br />在<?php EchoNameLink('simpletest', ACCOUNT_TOOL_EDIT_CN); ?>用户界面加了16进制显示后, 发现161116后多了一个0x20的空格. 我猜可能因为输入控件是单行的所以换行被过滤掉了, 干脆就放弃了自己分析未知字符.
<br />目前我用的jEdit编辑器没有16进制显示的功能, 于是我去下载了一个很多年没再用过的UltraEdit, 然而它显示161116后是20 0D 0A, 这3个太正常了, 早已经在<font color=gray><code>$strText = trim($strText, " ,.\n\r\t\v\0");</code></font>中处理过.
<br />这下黔驴技穷了, 只好找用户问到底输入了什么. 被告知是从一篇微信公众号文章复制过来的, 我跑去看页面源代码, 发现原文是<font color=green>161116&amp;nbsp;</font>, 微信复制后产生了一个UTF8的双字节空格字符,
加了一句<font color=gray><code>$strText = str_replace("\xC2\xA0", '', $strText);</code></font>后终于解决问题.
</p>

<h3><?php EchoNameTag('dicecaptcha', ACCOUNT_TOOL_DICE_CN); ?></h3>
<p>2021年7月2日
<br />罗布乐思Roblox<?php EchoDiceCaptchaLink(); ?>
<?php echo ImgRobloxDice(); ?>
</p>

</div>

<?php _LayoutBottom(); ?>

</body>
</html>
