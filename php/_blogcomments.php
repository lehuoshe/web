<?php
//require_once('account.php');
require_once('layout.php');
require_once('ui/commentparagraph.php');
require_once('/account/php/_editcommentform.php');

function _echoPreviousComments($strBlogId, $strMemberId, $bReadOnly, $bAdmin, $bChinese)
{
    $strQuery = 'blog_id='.$strBlogId;
    $strWhere = SqlWhereFromUrlQuery($strQuery);
    $iTotal = SqlCountBlogComment($strWhere);
    if ($iTotal == 0)
    {
	    $str = $bChinese ? '本页面尚无任何评论.' : 'No comments for this page yet.';
    }
    else
    {
		$str = $bChinese ? '本页面评论' : ' Comments for this page';
    }
	
	echo '<div>';
    EchoCommentLinkParagraph($str, $strQuery, $bChinese);
    if ($iTotal > 0)    EchoCommentParagraphs($strMemberId, $bReadOnly, $bAdmin, $strWhere, 0, MAX_COMMENT_DISPLAY, $bChinese);    
    echo '</div>';
}

function EchoBlogComments($bChinese = true)
{
    global $acct;
    
    $strMemberId = $acct->GetLoginId();
    
	$sql = new PageSql();
	$strBlogId = $sql->GetId(UrlGetUri());

	_echoPreviousComments($strBlogId, $strMemberId, $acct->IsReadOnly(), $acct->IsAdmin(), $bChinese);
	if ($strMemberId) 
	{
        EditCommentForm(($bChinese ? BLOG_COMMENT_NEW_CN : BLOG_COMMENT_NEW), $strMemberId);
    }
}


?>
