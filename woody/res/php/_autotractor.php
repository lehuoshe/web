<?php
require_once('_stock.php');

function _echoAutoTractor()
{
	$str = '在'.GetExternalLink('http://www.chinastock.com.cn/yhwz/service/download.shtml', '银河证券官网').'下载并在缺省路径<font color=blue>C:\中国银河证券海王星独立交易\Tc.exe</font>安装<b>海王星单独委托版</b>. ';
	$str .= '安装后桌面图标显示<font color=green>中国银河证券海王星独立交易</font>, 注意它不同于<font color=red>海王星金融终端</font>软件.';
    EchoParagraph($str);
    
    EchoHeadLine('AutoIt');
    EchoParagraph('测试步骤:');
	$str = '在'.GetExternalLink('https://tesseract-ocr.github.io/', 'Tesseract官方支持网站').'下载开源的Tesseract软件. 不过目前它被墙了, 如果你不想从'.GetExternalLink('https://github.com/tesseract-ocr/tesseract', 'Tesseract源代码').'自己下载编译的话, ';
	$str .= '可以在'.GetExternalLink('https://sourceforge.net/projects/tesseract-ocr-alt/files/', 'SourceForge').'下载一个镜像文件'.GetFileLink('/download/tesseract-ocr-setup-3.02.02.exe').', 然后一路回车缺省安装.';
    EchoOrderList($str);
	$str = '不想自己修改脚本文件, 希望直接运行可执行.exe文件的, 可以直接下载'.GetFileLink('/debug/yinhe.zip').'后解压缩, 然后参考后续脚本说明运行.';
	$str .= '<br />注意360杀毒软件一定会提示是病毒, 要手工告诉它这不是病毒.';
	$str .= '<br /><font color=red>可执行.exe文件更新不会像.au3脚本源文件那样及时, 注意留心显示的软件版本号.</font>';
    EchoOrderList($str);
	$str = '在'.GetExternalLink('https://www.autoitscript.com/site/autoit/downloads/', 'AutoIt官网').'下载并安装该工具软件包. ';
	$str .= '不熟悉英文的可以找国内的汉化版本, 仅需用到x86版本的AutoIt3.exe文件. 不过一定要小心软件来源, 千万不要运行来历不明的.exe文件.';
    EchoOrderList($str);
	$str = '在本页面下载银河拖拉机自动化PC软件脚本的3个文件到同一个子目录下, 分别是'.GetFileLink('/autoit/yinhe.au3').' '.GetFileLink('/debug/autoitscript/yinheaccounts.au3').'和'.GetFileLink('/debug/autoitscript/Tesseract.au3');
	$str .= '. <br />建议用AutoIt自带的SciTE.exe编辑和查看.au3文件. 文件yinheaccount.au3用来编辑各自的账号和密码, 目前里面有3个账号的位置, 不够的可以自己加, 不过注意别换行, 增加账号和密码后记得改动数字3. ';
	$str .= '<br />脚本运行后会把账号和密码存储在注册表中, 修改yinheaccount.au3后, 需要在客户号列表的鼠标右键菜单点击<font color=blue>清除全部客户号记录</font>选项, 然后下次运行才会使用改动后的账号密码.';
	$str .= '<br />文件会日常更新, 由于更新时无法覆盖所有的测试, 每次下载新版本前注意备份好上一个能用的版本.';
    EchoOrderList($str);
	$str = '运行AutoIt3.exe, 它会提示输入文件, 给它yinhe.au3. 在弹出的用户界面直接回车或者鼠标点击<font color=blue>执行自动操作</font>按键后, 会看到它会自动运行<b>海王星单独委托版</b>, 一步步在每个yinheaccount.au3中账号的6个深市账户各自申购100块华宝油气(SZ162411), 最后退出. ';
	$str .= '<br />除了按ESC键主动退出和响应AutoIt脚本自己的错误提示消息框外, 在结束前不能操作任何键盘或者鼠标, 否则脚本可能会出错.';
    EchoOrderList($str);
    
	EchoParagraph('<font color=red>已知问题:</font>');
	$str = '银河证券官网现在的海王星独立交易升级了, 导致模拟输入不匹配, 老用户先别升级, 新用户可以暂停测试. 目前0.50版本会自动取消升级提示.';
    EchoOrderList($str);
	$str = '网速很重要! 在目前代码中有大量模拟按键或者鼠标后等待一秒的被动行为, 在网速慢的时候会因为等待时间不够长而出错, 我就经常需要在运行代码前先手工把电脑上的网络从天威宽带切换到自己手机上的移动4G热点.';
    EchoOrderList($str);
	$str = '在小屏幕笔记本上, 显示设置的<font color=green>缩放与布局</font>中, <font color=blue>更改文本、应用等项目的大小</font>的选项缺省不是100%, 这时AutoIt自带的WinGetPos函数不会跟着调整倍数, 导致找不到验证码位置. ';
    EchoOrderList($str);
	$str = '银河0开头的客户号, 需要把开头的0去掉, 否则登录后匹配不到主窗口.';
    EchoOrderList($str);
	$str = '在基金概要文件那部分, IE会弹出框让选择打开或者下载, 需要手工点一下, 要不到不了下一步. 给IE安装adobe的阅读pdf插件后能解决这个问题. 在电脑上安装一下Adobe官方的免费PDF阅读器软件也可以解决这个问题.';
    EchoOrderList($str);
	$str = 'WIN7系统下海王星不能正常退出, 可以运行系统自带的注册表编辑器regedit.exe, 依次定位到HKEY_CURRENT_USER\Software\Microsoft\Windows\WindowsError Reporting, 在右侧窗口中找到并双击打开DontshowUI, 然后在弹出的窗口中将默认值<font color=blue>0</font>修改为<font color=blue>1</font>.';
	$str .= '这样当程序崩溃时, 就不会再出现<font color=green>xx程序已停止工作</font>的提示框, 崩溃程序进程会自动退出.';
    EchoOrderList($str);
/*
    EchoHeadLine('Python');
    EchoParagraph('Life is short, you need Python. <font color=red>计划开发中, 没有时间表!</font>');
    $str = '在'.GetExternalLink('https://www.python.org/downloads/windows/', 'Python官网').'下载并安装Windows版本软件, 选择'.GetExternalLink('https://www.python.org/ftp/python/3.9.0/python-3.9.0.exe', 'Windows x86 executable installer');
	$str .= '. <br />然后就要安装Python有名的各种库了, 在Windows左下角窗口标志右边放大镜框中输入<font color=blue>cmd</font>然后回车, 会进入类似<font color=blue>C:\Users\woody</font>的黑色屏幕地方, 然后在光标处输入<font color=blue>cd AppData\Local\Programs\Python\Python39-32\Scripts</font>, 就到了安装库的地方.';
	$str .= '<br />输入<font color=blue>pip install pypiwin32</font>, 安装win32api需要的Windows库.';
    EchoOrderList($str);*/
}

function EchoAll()
{
	global $acct;
    
	_echoAutoTractor();
    $acct->EchoLinks();
}

function EchoMetaDescription()
{
  	$str = '利用安卓手机上的autojs和PC上的autoit等script脚本工具软件实现华宝油气(SZ162411)等场内基金拖拉机账户的自动化申购和卖出, 提高几万套利党人的时间效率. ';
    EchoMetaDescriptionText($str);
}

function EchoTitle()
{
  	echo AUTO_TRACTOR_DISPLAY;
}

	$acct = new StockAccount();
?>
