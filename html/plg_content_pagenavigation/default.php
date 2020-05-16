<?php
/**
 * @package     Joomla.Plugin
 * @subpackage  Content.pagenavigation
 *
 * @copyright   Copyright (C) 2005 - 2018 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

$lang = JFactory::getLanguage(); ?>
<div class="container">
<ul class="pager pagenav d-flex justify-content-between align-items-end">
<li class="previous">
<?php $direction = $lang->isRtl() ? 'right' : 'left'; ?>
<?php if ($row->prev) : ?>
		<a class="hasTooltip" title="<?php echo htmlspecialchars($rows[$location-1]->title); ?>" aria-label="<?php echo JText::sprintf('JPREVIOUS_TITLE', htmlspecialchars($rows[$location-1]->title)); ?>" href="<?php echo $row->prev; ?>" rel="prev">
			<?php echo '<i class="fa fa-chevron-' . $direction . '" aria-hidden="true"></i> <span aria-hidden="true">' . $row->prev_label . '  </span>'; ?>
		</a>
<?php else: ?>

<?php endif; ?>
<li class="text-center socialshare">
<?php
if($row->parent_id == 1){
	$catID = $row->catid;
} else {
	$catID = $row->parent_id;
}

?>
<p class="h3 text-strong">Share this:</p>
<?php
$doc = JFactory::getDocument();
$getUri = JFactory::getURI();
$current_url = $getUri->toString();
$page_title = $doc->getTitle();
?>
<a class="mr-4" href="http://twitter.com/share?url=<?php echo $current_url; ?>&amp;text=<?php echo str_replace(" ", "%20", $page_title); ?>" onClick="window.open('http://twitter.com/share?url=<?php echo urlencode($current_url); ?>&amp;text=<?php echo str_replace(" ", "%20", $page_title );?>','Twitter share', 'width=600,height=300, left='+(screen.availWidth/2-300)+',top='+(screen.availHeight/2-150)+''); return false;"><i class="fa fa-twitter" aria-hidden="true"></i></a>
<a class="mr-4" onClick="window.open('https://www.facebook.com/sharer.php?u=<?php echo $current_url; ?>,'Facebook','width=600,height=300,left='+(screen.availWidth/2-300)+',top='+(screen.availHeight/2-150)+''); return false;" href="https://www.facebook.com/sharer.php?u=<?php echo $current_url; ?>"><i class="fa fa-facebook" aria-hidden="true"></i></a>
<a class="mr-4" onClick="window.open('https://plus.google.com/share?url=<?php echo $current_url; ?>','Google plus','width=585,height=666,left='+(screen.availWidth/2-292)+',top='+(screen.availHeight/2-333)+''); return false;" href="https://plus.google.com/share?url=<?php echo $current_url; ?>" ><i class="fa fa-google-plus" aria-hidden="true"></i></a>
<a class="mr-4" onClick="window.open('http://www.linkedin.com/shareArticle?mini=true&url=<?php echo $current_url; ?>','Linkedin','width=585,height=666,left='+(screen.availWidth/2-292)+',top='+(screen.availHeight/2-333)+''); return false;" href="http://www.linkedin.com/shareArticle?mini=true&url=<?php echo $current_url; ?>" ><i class="fa fa-linkedin" aria-hidden="true"></i></a>
<a class="" onClick="window.open('http://pinterest.com/pin/create/button/?url=<?php echo $current_url; ?>&amp;description=<?php echo $page_title; ?>','Pinterest','width=585,height=666,left='+(screen.availWidth/2-292)+',top='+(screen.availHeight/2-333)+''); return false;" href="http://pinterest.com/pin/create/button/?url=<?php echo $current_url; ?>&amp;description=<?php echo $page_title; ?>" ><i class="fa fa-pinterest" aria-hidden="true"></i></a>
</li>
</li>
<li class="next">
	<?php $direction = $lang->isRtl() ? 'left' : 'right'; ?>
<?php if ($row->next) : ?>
		<a class="hasTooltip" title="<?php echo htmlspecialchars($rows[$location+1]->title); ?>" aria-label="<?php echo JText::sprintf('JNEXT_TITLE', htmlspecialchars($rows[$location+1]->title)); ?>" href="<?php echo $row->next; ?>" rel="next">
			<?php echo '<span aria-hidden="true">' . $row->next_label . ' </span> <i class="fa fa-chevron-' . $direction . '" aria-hidden="true"></i>'; ?>
		</a>
<?php else: ?>

<?php endif; ?>
</li>
</ul>
</div>