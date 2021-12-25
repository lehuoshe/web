<?php
require('php/_blogtype.php');

function EchoMetaDescription()
{
	echo 'Woody的AR1688相关的网络日志列表. 包括AR1688芯片介绍, 方案说明, 提供给第3方开发的软件API教程等内容. 以及从SDCC 2.8.0版本开始后使用其中Z80编译器的各种吐槽.';
}

function EchoAll()
{
    echo <<<END
<p>2012年11月11日 <a href="ar1688/20121111cn.php">找出两幅图不同之处</a>
<br />2012年4月30日 <a href="ar1688/20120430cn.php">使用RFC 2833发送PTT</a>
<br />2012年2月13日 <a href="ar1688/20120213cn.php">不带串口功能的AR168M网络语音模块</a>
<br />2011年12月5日 <a href="ar1688/20111205cn.php">AR168M网络语音模块功能测试</a>
<br />2011年10月7日 <a href="ar1688/20111007cn.php">每个人都会问愚蠢问题</a>
<br />2011年8月26日 <a href="ar1688/20110826cn.php">愚蠢还是其它? </a>
<br />2011年4月3日 <a href="ar1688/20110403cn.php">在Asterisk系统下禁用STUN</a>
<br />2011年3月31日 <a href="ar1688/20110331cn.php">AR1688编程第一课</a>
<br />2011年3月7日 <a href="ar1688/20110307cn.php">语音提示</a>
<br />2010年12月2日 <a href="ar1688/20101202cn.php">烧录程序存储器</a>
<br />2010年11月23日 <a href="ar1688/20101123cn.php">SDCC 3.0.0之路</a>
<br />2010年8月18日 <a href="ar1688/20100818cn.php">用VC2008编译AR1688 Windows下工具</a>
<br />2010年6月25日 <a href="ar1688/20100625cn.php">卖到断货</a>
<br />2009年4月16日 <a href="ar1688/20090416cn.php">活动语音检测</a>
<br />2009年3月29日 <a href="ar1688/20090329cn.php">SDCC编译器2.9.0</a>
<br />2009年3月20日 <a href="ar1688/20090320cn.php">按#键呼叫</a>
<br />2009年2月17日 <a href="ar1688/20090217cn.php">低成本电话</a>
<br />2008年12月2日 <a href="ar1688/20081202cn.php">AR1688 Z80性能</a>
<br />2008年11月24日 <a href="ar1688/20081124cn.php">Micrel KSZ8842网络芯片</a>
<br />2008年9月3日 <a href="ar1688/20080903cn.php">GPIO控制</a>
<br />2008年8月11日 <a href="ar1688/20080811cn.php">标准第一</a>
<br />2008年7月29日 <a href="ar1688/20080729cn.php">路由器, PPPoE和DM9003</a>
<br />2008年7月16日 <a href="ar1688/20080716cn.php">缺省设置</a>
<br />2008年7月8日 <a href="ar1688/20080708cn.php">AR168M模块应用举例</a>
<br />2008年7月6日 <a href="ar1688/20080706cn.php">AR1688 Z80地址空间</a>
<br />2008年6月24日 <a href="ar1688/20080624cn.php">安全模式下的升级</a>
<br />2008年6月15日 <a href="ar1688/20080615cn.php">告别RTL8019AS</a>
<br />2008年6月7日 <a href="ar1688/20080607cn.php">命名规则</a>
<br />2008年5月12日 <a href="ar1688/20080512cn.php">显示短消息</a>
<br />2008年3月30日 <a href="ar1688/20080330cn.php">8051软件细节</a>
<br />2008年3月29日 <a href="ar1688/20080329cn.php">AR168M VoIP模块高层用户界面协议</a>
<br />2008年2月25日 <a href="ar1688/20080225cn.php">AR168M VoIP模块</a>
<br />2008年2月22日 <a href="ar1688/20080222cn.php">在AR1688软件中添加ISO 8859-2字库的具体步骤</a>
<br />2008年2月16日 <a href="ar1688/20080216cn.php">字库资源</a>
<br />2008年1月21日 <a href="ar1688/20080121cn.php">Z80速度</a>
<br />2008年1月20日 <a href="ar1688/20080120cn.php">不要升级"长"铃音</a>
<br />2007年11月27日 <a href="ar1688/20071127cn.php">另外一个片选信号</a>
<br />2007年11月19日 <a href="ar1688/20071119cn.php">简单串口</a>
<br />2007年11月16日 <a href="ar1688/20071116cn.php">RTP优先</a>
<br />2007年11月14日 <a href="ar1688/20071114cn.php">语音帧数</a>
<br />2007年11月10日 <a href="ar1688/20071110cn.php">IAX2协议下Speex实际使用带宽</a>
<br />2007年10月31日 <a href="ar1688/20071031cn.php">计算Speex实际使用带宽</a>
<br />2007年8月27日 <a href="ar1688/20070827cn.php">如何改MAC地址</a>
<br />2007年7月4日 <a href="ar1688/20070704cn.php">调试常见问题</a>
<br />2007年6月9日 <a href="ar1688/20070609cn.php">如何在Linux下编译AR1688 API</a>
<br />2007年6月5日 <a href="ar1688/20070605cn.php">如何更新字库</a>
<br />2007年6月4日 <a href="ar1688/20070604cn.php">2x16字符型LCD中的字库</a>
<br />2007年6月3日 <a href="ar1688/20070603cn.php">ISO 8859字库</a>
<br />2007年4月5日 <a href="ar1688/20070405cn.php">地区和语言选项</a>
<br />2007年3月28日 <a href="ar1688/20070328cn.php">铃音和通话保持音乐</a>
<br />2007年3月21日 <a href="ar1688/20070321cn.php">拨号映射</a>
<br />2007年3月7日 <a href="ar1688/20070307cn.php">iLBC编码算法完成</a>
<br />2007年2月16日 <a href="ar1688/20070216cn.php">为什么支持ADPCM G.726 32k编码算法</a>
<br />2006年12月14日 <a href="ar1688/20061214cn.php">AR168F网络电话的软件特性</a>
<br />2006年12月13日 <a href="ar1688/20061213cn.php">AR168F网络电话的硬件特性</a>
<br />2006年12月12日 <a href="ar1688/20061212cn.php">芯片特性</a>
<br />2006年12月11日 <a href="ar1688/20061211cn.php">软件API内容</a>
<br />2006年10月14日 <a href="ar1688/20061014cn.php">芯片名称和硬件型号</a>
<br />2006年9月30日 <a href="ar1688/20060930cn.php">软件升级大小</a>
<br />2006年9月29日 <a href="ar1688/20060929cn.php">软件升级</a>
<br />2006年9月28日 <a href="ar1688/20060928cn.php">什么是AR1688</a>
</p>
END;
}

require('/php/ui/_dispcn.php');
?>
