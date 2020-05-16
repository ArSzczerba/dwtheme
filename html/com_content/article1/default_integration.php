<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_content
 *
 * @copyright   Copyright (C) 2005 - 2018 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

JHtml::addIncludePath(JPATH_COMPONENT . '/helpers');
JLoader::register('FieldsHelper', JPATH_ADMINISTRATOR . '/components/com_fields/helpers/fields.php');

// Create shortcuts to some parameters.
$params  = $this->item->params;
$images  = json_decode($this->item->images);
$urls    = json_decode($this->item->urls);
$canEdit = $params->get('access-edit');
$user    = JFactory::getUser();
$info    = $params->get('info_block_position', 0);

$doc = JFactory::getDocument();
$getUri = JFactory::getURI();
$current_url = $getUri->toString();
$page_title = $doc->getTitle();

// Check if associations are implemented. If they are, define the parameter.
$assocParam = (JLanguageAssociations::isEnabled() && $params->get('show_associations'));
JHtml::_('behavior.caption');

?>

<div class="item-page<?php echo $this->pageclass_sfx; ?>" itemscope itemtype="https://schema.org/Article">
	<meta itemprop="inLanguage" content="<?php echo ($this->item->language === '*') ? JFactory::getConfig()->get('language') : $this->item->language; ?>" />
	<?php if ($this->params->get('show_page_heading')) : ?>
	<div class="page-header">
		<h1> <?php echo $this->escape($this->params->get('page_heading')); ?> </h1>
	</div>
	<?php endif;
	if (!empty($this->item->pagination) && $this->item->pagination && !$this->item->paginationposition && $this->item->paginationrelative)
	{
		echo $this->item->pagination;
	}
	?>

<?php if($this->item->isBlog){ ?>
	<div class="chit-chat-top container pt-5 pb-3 d-flex justify-content-between align-items-center">
		<div class="created_by d-flex align-items-center">
			<div class="avatar">
			<?php JLoader::register('FieldsHelper', JPATH_ADMINISTRATOR . '/components/com_fields/helpers/fields.php');
				$fields = FieldsHelper::getFields('com_users.user',  JFactory::getUser($item->created_by));
				$class= "";
				foreach ($fields as $field) {
					if( $field->label == 'avatar' && !empty($field->value) ) {
						$avatar = new JImage($field->value);
					}
				}

				if(!isset($avatar) ){
					$avatar = new JImage( "images/logo/avatar.png" );
					$class = 'class="img-fluid"';
				}
				echo '<img '. $class .' src="'. $avatar->createThumbs(array("52x52"), JImage::CROP_RESIZE)[0]->getPath().'"/>';
			?>
			</div>
		 <?php $author = ($this->item->created_by_alias ?: $this->item->author); ?>
		 <span class="author">by <?php echo $author; ?></span>&nbsp;&bull;&nbsp;
		 <span><?php echo JHtml::_('date', $this->item->created, JText::_('l jS F Y')); ?></span>

		</div>
		<div class="socialshare">
		<p><span>Share this post:</span>
			<a class="mr-1" href="http://twitter.com/share?url=<?php echo $current_url; ?>&amp;text=<?php echo str_replace(" ", "%20", $page_title); ?>" onClick="window.open('http://twitter.com/share?url=<?php echo urlencode($current_url); ?>&amp;text=<?php echo str_replace(" ", "%20", $page_title );?>','Twitter share', 'width=600,height=300, left='+(screen.availWidth/2-300)+',top='+(screen.availHeight/2-150)+''); return false;"><i class="fa fa-twitter" aria-hidden="true"></i></a>
			<a class="mr-1" onClick="window.open('https://www.facebook.com/sharer.php?u=<?php echo $current_url; ?>,'Facebook','width=600,height=300,left='+(screen.availWidth/2-300)+',top='+(screen.availHeight/2-150)+''); return false;" href="https://www.facebook.com/sharer.php?u=<?php echo $current_url; ?>"><i class="fa fa-facebook" aria-hidden="true"></i></a>
			<a class="mr-1" onClick="window.open('https://plus.google.com/share?url=<?php echo $current_url; ?>','Google plus','width=585,height=666,left='+(screen.availWidth/2-292)+',top='+(screen.availHeight/2-333)+''); return false;" href="https://plus.google.com/share?url=<?php echo $current_url; ?>" ><i class="fa fa-google-plus" aria-hidden="true"></i></a>
			<a class="mr-1" onClick="window.open('http://www.linkedin.com/shareArticle?mini=true&url=<?php echo $current_url; ?>','Linkedin','width=585,height=666,left='+(screen.availWidth/2-292)+',top='+(screen.availHeight/2-333)+''); return false;" href="http://www.linkedin.com/shareArticle?mini=true&url=<?php echo $current_url; ?>" ><i class="fa fa-linkedin" aria-hidden="true"></i></a>
			<a class="mr-1" onClick="window.open('http://pinterest.com/pin/create/button/?url=<?php echo $current_url; ?>&amp;description=<?php echo $page_title; ?>','Pinterest','width=585,height=666,left='+(screen.availWidth/2-292)+',top='+(screen.availHeight/2-333)+''); return false;" href="http://pinterest.com/pin/create/button/?url=<?php echo $current_url; ?>&amp;description=<?php echo $page_title; ?>" ><i class="fa fa-pinterest" aria-hidden="true"></i></a>
		</div>

	</div>
	<div class="container"><hr></div>
<?php } ?>

	<?php // Todo Not that elegant would be nice to group the params ?>
	<?php $useDefList = ($params->get('show_modify_date') || $params->get('show_publish_date') || $params->get('show_create_date')
	|| $params->get('show_hits') || $params->get('show_category') || $params->get('show_parent_category') || $params->get('show_author') || $assocParam); ?>

	<?php if (!$useDefList && $this->print) : ?>
		<div id="pop-print" class="btn hidden-print">
			<?php echo JHtml::_('icon.print_screen', $this->item, $params); ?>
		</div>
		<div class="clearfix"> </div>
	<?php endif; ?>
	<?php if ($params->get('show_title') || $params->get('show_author')) : ?>
	<div class="page-header">
		<?php if ($params->get('show_title')) : ?>
			<h2 itemprop="headline">
				<?php echo $this->escape($this->item->title); ?>
			</h2>
		<?php endif; ?>
		<?php if ($this->item->state == 0) : ?>
			<span class="label label-warning"><?php echo JText::_('JUNPUBLISHED'); ?></span>
		<?php endif; ?>
		<?php if (strtotime($this->item->publish_up) > strtotime(JFactory::getDate())) : ?>
			<span class="label label-warning"><?php echo JText::_('JNOTPUBLISHEDYET'); ?></span>
		<?php endif; ?>
		<?php if ((strtotime($this->item->publish_down) < strtotime(JFactory::getDate())) && $this->item->publish_down != JFactory::getDbo()->getNullDate()) : ?>
			<span class="label label-warning"><?php echo JText::_('JEXPIRED'); ?></span>
		<?php endif; ?>
	</div>
	<?php endif; ?>
	<?php if (!$this->print) : ?>
		<?php if ($canEdit || $params->get('show_print_icon') || $params->get('show_email_icon')) : ?>
			<?php echo JLayoutHelper::render('joomla.content.icons', array('params' => $params, 'item' => $this->item, 'print' => false)); ?>
		<?php endif; ?>
	<?php else : ?>
		<?php if ($useDefList) : ?>
			<div id="pop-print" class="btn hidden-print">
				<?php echo JHtml::_('icon.print_screen', $this->item, $params); ?>
			</div>
		<?php endif; ?>
	<?php endif; ?>

	<?php // Content is generated by content plugin event "onContentAfterTitle" ?>
	<?php echo $this->item->event->afterDisplayTitle; ?>

	<?php if ($useDefList && ($info == 0 || $info == 2)) : ?>
		<?php // Todo: for Joomla4 joomla.content.info_block.block can be changed to joomla.content.info_block ?>
		<?php echo JLayoutHelper::render('joomla.content.info_block.block', array('item' => $this->item, 'params' => $params, 'position' => 'above')); ?>
	<?php endif; ?>

	<?php if ($info == 0 && $params->get('show_tags', 1) && !empty($this->item->tags->itemTags)) : ?>
		<?php $this->item->tagLayout = new JLayoutFile('joomla.content.tags'); ?>

		<?php echo $this->item->tagLayout->render($this->item->tags->itemTags); ?>
	<?php endif; ?>

	<?php // Content is generated by content plugin event "onContentBeforeDisplay" ?>
	<?php echo $this->item->event->beforeDisplayContent; ?>

	<?php if (isset($urls) && ((!empty($urls->urls_position) && ($urls->urls_position == '0')) || ($params->get('urls_position') == '0' && empty($urls->urls_position)))
		|| (empty($urls->urls_position) && (!$params->get('urls_position')))) : ?>
	<?php echo $this->loadTemplate('links'); ?>
	<?php endif; ?>
	<?php if ($params->get('access-view')) : ?>
	<?php echo JLayoutHelper::render('joomla.content.full_image', $this->item); ?>
	<?php
	if (!empty($this->item->pagination) && $this->item->pagination && !$this->item->paginationposition && !$this->item->paginationrelative) :
		echo $this->item->pagination;
	endif;
	?>
	<?php if (isset ($this->item->toc)) :
		echo $this->item->toc;
	endif; ?>
	<div itemprop="articleBody">
		<?php echo $this->item->text; ?>
	</div>

	<?php if ($info == 1 || $info == 2) : ?>
		<?php if ($useDefList) : ?>
				<?php // Todo: for Joomla4 joomla.content.info_block.block can be changed to joomla.content.info_block ?>
			<?php echo JLayoutHelper::render('joomla.content.info_block.block', array('item' => $this->item, 'params' => $params, 'position' => 'below')); ?>
		<?php endif; ?>
		<?php if ($params->get('show_tags', 1) && !empty($this->item->tags->itemTags)) : ?>
			<?php $this->item->tagLayout = new JLayoutFile('joomla.content.tags'); ?>
			<?php echo $this->item->tagLayout->render($this->item->tags->itemTags); ?>
		<?php endif; ?>
	<?php endif; ?>

	<?php
	if (!empty($this->item->pagination) && $this->item->pagination && $this->item->paginationposition && !$this->item->paginationrelative) :
		echo $this->item->pagination;
	?>
	<?php endif; ?>
	<?php if (isset($urls) && ((!empty($urls->urls_position) && ($urls->urls_position == '1')) || ($params->get('urls_position') == '1'))) : ?>
	<?php echo $this->loadTemplate('links'); ?>
	<?php endif; ?>
	<?php // Optional teaser intro text for guests ?>
	<?php elseif ($params->get('show_noauth') == true && $user->get('guest')) : ?>
	<?php echo JLayoutHelper::render('joomla.content.intro_image', $this->item); ?>
	<?php echo JHtml::_('content.prepare', $this->item->introtext); ?>
	<?php // Optional link to let them register to see the whole article. ?>
	<?php if ($params->get('show_readmore') && $this->item->fulltext != null) : ?>
	<?php $menu = JFactory::getApplication()->getMenu(); ?>
	<?php $active = $menu->getActive(); ?>
	<?php $itemId = $active->id; ?>
	<?php $link = new JUri(JRoute::_('index.php?option=com_users&view=login&Itemid=' . $itemId, false)); ?>
	<?php $link->setVar('return', base64_encode(ContentHelperRoute::getArticleRoute($this->item->slug, $this->item->catid, $this->item->language))); ?>
	<p class="readmore">
		<a href="<?php echo $link; ?>" class="register">
		<?php $attribs = json_decode($this->item->attribs); ?>
		<?php
		if ($attribs->alternative_readmore == null) :
			echo JText::_('COM_CONTENT_REGISTER_TO_READ_MORE');
		elseif ($readmore = $attribs->alternative_readmore) :
			echo $readmore;
			if ($params->get('show_readmore_title', 0) != 0) :
				echo JHtml::_('string.truncate', $this->item->title, $params->get('readmore_limit'));
			endif;
		elseif ($params->get('show_readmore_title', 0) == 0) :
			echo JText::sprintf('COM_CONTENT_READ_MORE_TITLE');
		else :
			echo JText::_('COM_CONTENT_READ_MORE');
			echo JHtml::_('string.truncate', $this->item->title, $params->get('readmore_limit'));
		endif; ?>
		</a>
	</p>
	<?php endif; ?>
	<?php endif; ?>
	<?php
	if (!empty($this->item->pagination) && $this->item->pagination && $this->item->paginationposition && $this->item->paginationrelative) :
		echo $this->item->pagination;
	?>
	<?php endif; ?>
	<?php // Content is generated by content plugin event "onContentAfterDisplay" ?>
	<?php echo $this->item->event->afterDisplayContent; ?>

	<div class="container"><hr></div>

	<?php foreach($this->item->jcfields as $jcfield) {
    		$this->item->jcFields[$jcfield->name] = $jcfield;
    } ?>

	<?php if(sizeof($this->item->jcFields)) { ?>
		<div class="related">
			<h2 class="text-center">You might also like</h2>
			<div class="container">
				<div class="row">
					<div class="col-md-4">
						<?php echo $this->item->jcFields['related-article-1']->value; ?>
					</div>
					<div class="col-md-4">
						<?php echo $this->item->jcFields['related-article-2']->value; ?>
					</div>
					<div class="col-md-4">
						<?php echo $this->item->jcFields['related-article-3']->value; ?>
					</div>
				</div>

			</div>
		</div>
	<?php } ?>

</div>