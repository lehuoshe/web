<?php
require_once('_stock.php');
require_once('/php/ui/imagedisp.php');

define('YINHE_AU3_VER', '50');

function EchoAll()
{
	global $acct;
    
    EchoParagraph(GetRemarkElement('完整软件安装步骤：'));
    $strNepturnLink = GetExternalLink('http://www.chinastock.com.cn/newsite/online/downloadCenterDetail.html?softName=neptune', '银河证券官网');
    $strNepturn = GetBoldElement('海王星单独委托版V2.95');
    echo GetListElement(array('在'.$strNepturnLink.'下载并在缺省路径安装'.$strNepturn.'，桌面图标会显示'.GetInfoElement('中国银河证券海王星独立交易').'，注意它不同于'.GetFontElement('海王星金融终端').'软件。',
    							'下载开源的'.GetExternalLink('https://tesseract-ocr.github.io/', 'Tesseract软件').'用来识别登录验证码。也可以在'.GetExternalLink('https://sourceforge.net/projects/tesseract-ocr-alt/files/', 'SourceForge').'下载一个镜像文件'.GetFileLink('/download/tesseract-ocr-setup-3.02.02.exe').'，然后一路回车缺省安装。',
    							'下载并安装开源的'.GetExternalLink('https://www.autoitscript.com/site/autoit/downloads/', 'AutoIt').'工具软件包。普通用户实际仅需用到x86版本的AutoIt3.exe文件。一定要小心软件来源，千万不要运行来历不明的.exe文件。',
    							'在本页面下载银河拖拉机自动化PC软件脚本的3个文件到同一个子目录下，分别是'.GetFileLink('/autoit/yinhe.au3').'、'.GetFileLink('/debug/autoitscript/yinheaccounts.au3').'和'.GetFileLink('/debug/autoitscript/Tesseract.au3').'。'));
    
   	$strNewLine = GetBreakElement();
   	$strYinheAu3 = GetInfoElement('yinhe.au3');
   	$strYinheAu3Now = GetInfoElement('yinhe0'.YINHE_AU3_VER.'.au3');
    $str = GetRemarkElement('软件更新：');
    $str .= $strNewLine.$strYinheAu3.'文件是唯一会日常更新的，目前版本为'.GetBoldElement('V0.'.YINHE_AU3_VER).'。由于更新时无法覆盖所有的测试，每次下载新版本前注意备份好上一个能用的版本。例如保存成：'.$strYinheAu3Now;
    EchoParagraph($str);

    $str = GetRemarkElement('软件执行：');
    $str .= $strNewLine.'运行AutoIt3.exe后， 它会提示输入文件。给它'.$strYinheAu3.'或者'.$strYinheAu3Now.'都可以执行。';
    $str .= QuoteImgElement('20211129auto.jpg', 'AutoIt'.AUTO_TRACTOR_DISPLAY.'软件0.49主界面');
    $str .= $strNewLine.'在弹出的用户主界面用鼠标点击'.GetInfoElement('执行自动操作').'按键后，会看到它自动运行'.$strNepturn.'，然后一步步在每个'.GetInfoElement('客户号').'的6个深市账户各自执行选择的'.GetInfoElement('操作').
    		'。除了按ESC键主动退出和响应AutoIt脚本自己的错误提示消息框外，在结束前不能操作任何键盘或者鼠标，否则脚本可能会出错。';
    EchoParagraph($str);
    
    $strFund = GetInfoElement('基金代码').'加亮选中基金';
    $strQuantity = GetInfoElement('卖出或者赎回总数量').'或者'.GetQuoteElement('缺省为空').'全部';
    echo GetListElement(array('转账回银行：把剩余可转银行资金全部转回，这里假定了银行资金密码和该客户号的登录密码是一样的。',
    							'深市逆回购：把剩余可用资金下单比场内价格低一毛卖出131810。',
    							'场内申购：按当日限购金额自动申购'.$strFund.'。',
    							'赎回：按'.$strQuantity.'赎回'.$strFund.'。',
    							'卖出：按'.GetInfoElement('卖出价格').'和'.$strQuantity.'卖出'.$strFund.'。',
    							'全部撤单：'.$strFund.'的全部申购、赎回或者卖出订单都会被一次性撤销。',
    							'仅登录查询：跟前面所有操作不同，这里登录全部打勾的客户号后不会自动退出'.$strNepturn.'。'
    						   ), false);

    $str = GetRemarkElement('管理客户号：');
    $str .= QuoteImgElement('20201029.jpg', 'AutoIt'.AUTO_TRACTOR_DISPLAY.'管理客户号界面');
    EchoParagraph($str);
    
   	$strManageAccount = GetInfoElement('添加或者修改选中客户号');
    echo GetListElement(array('修改：加亮选中'.GetQuoteElement('不是前面打勾').'某客户号时，按鼠标右键，选择'.$strManageAccount.'菜单，会继续弹出对话框修改当前客户号'.GetQuoteElement('上图中是23050008000').'。',
    							'添加：没选中任何客户号时，按鼠标右键，选择'.$strManageAccount.'菜单，会继续弹出对话框添加新客户号。',
    							'批量手工添加和修改：脚本运行后会把客户号和密码存储在注册表中。用AutoIt自带的SciTE.exe编辑'.GetInfoElement('yinheaccount.au3').'，缺省下载文件里面有3个账号的位置，不够的可以自己加。注意别换行，增加账号和密码后记得改动数字3。'.
    							$strNewLine.'保存后在客户号区域按鼠标右键，选择'.GetInfoElement('清除全部客户号记录').'，然后关闭AutoIt.exe软件重新运行，就会使用改动后的客户号和密码。',
    							GetFontElement('废弃电脑前，要记得清除全部客户号记录，避免泄露。')));
    $acct->EchoLinks();
    echo GetKnownBugs(array('在小屏幕笔记本上，显示设置的'.GetInfoElement('缩放与布局').'中，'.GetInfoElement('更改文本、应用等项目的大小').'的选项缺省不是100%。这时AutoIt自带的WinGetPos函数不会跟着调整倍数，导致找不到验证码位置。',
    						 '网速很重要！在目前代码中有大量模拟按键或者鼠标后等待一秒的被动行为，在网速慢的时候会因为等待时间不够长而出错。我就可能需要在运行代码前先手工把电脑上的网络从天威宽带切换到自己手机上的移动4G热点。',
    						 '在基金概要文件那部分，IE会弹出框让选择打开或者下载，需要手工点一下，要不到不了下一步。给IE安装adobe的阅读pdf插件后能解决这个问题。在电脑上安装一下Adobe官方的免费PDF阅读器软件也可以解决这个问题。',
    						 'WIN7系统下海王星不能正常退出。可以运行系统自带的注册表编辑器regedit.exe，依次定位到HKEY_CURRENT_USER\Software\Microsoft\Windows\WindowsError Reporting，在右侧窗口中找到并双击打开DontshowUI，然后在弹出的窗口中将默认值0修改为1。'));
}

function GetMetaDescription()
{
  	$str = '利用PC上的AutoIt脚本工具软件实现华宝油气(SZ162411)等场内基金拖拉机账户的自动化登录、申购、卖出和全部撤单，提高几万套利党人的时间效率。';
    return CheckMetaDescription($str);
}

function GetTitle()
{
	return AUTO_TRACTOR_DISPLAY;
}

	$acct = new StockAccount();
?>
