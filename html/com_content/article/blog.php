<?php

/**
 * @package     Joomla.Site
 * @subpackage  com_content
 *
 * @copyright   Copyright (C) 2005 - 2019 Open Source Matters, Inc. All rights reserved.
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

// Check if associations are implemented. If they are, define the parameter.
$assocParam = (JLanguageAssociations::isEnabled() && $params->get('show_associations'));
JHtml::_('behavior.caption');

?>
<div class="item-page<?php echo $this->pageclass_sfx; ?>" itemscope itemtype="https://schema.org/Article">
	<meta itemprop="inLanguage" content="<?php echo ($this->item->language === '*') ? JFactory::getConfig()->get('language') : $this->item->language; ?>" />
	<div class="article-intro">
		<div class="container">
			<div class="row justify-content-center text-center">
				<div class="col-md-6">
					<div class="page-header">
						
							<h1 itemprop="headline">
								<?php echo $this->escape($this->item->title); ?>
							</h1>
						
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
				</div>
			</div>

			<div class="row justify-content-center">
				<div class="created_by d-flex flex-column align-items-center">
				<div class="avatar">
					<?php 
						JLoader::register('FieldsHelper', JPATH_ADMINISTRATOR . '/components/com_fields/helpers/fields.php');
						$fields = FieldsHelper::getFields('com_users.user',  JFactory::getUser($this->item->created_by));
						$class = "";
						foreach ($fields as $field) {
							if ($field->label == 'avatar' && !empty($field->value)) {
								$avatar = new JImage($field->value);
							}
						}

						if (!isset($avatar)) {
							$avatar = new JImage("images/logo/default-avatar.jpg");
							$class = 'class="img-fluid"';
						}
						echo '<img ' . $class . ' src="' . $avatar->createThumbs(array("72x72"), JImage::SCALE_FIT)[0]->getPath() . '"/>';
					?>
				</div>
				<div itemprop="author" itemscope itemtype="https://schema.org/Person">
					<?php $author = ($this->item->created_by_alias ?: $this->item->author); ?>
					<?php $author = '<span itemprop="name">' . $author . '</span>'; ?>
					<p><?php echo $author; ?></p>
				</div>
	
			</div>

		</div>
	</div>
	</div>
	<div class="article-content">
		<div class="container">
			<?php echo JLayoutHelper::render('joomla.content.blog_full_image', $this->item); ?>
			<div class="article-details">
				<p><?php echo JHtml::_('date', $this->item->publish_up, JText::_('F jS, Y ')); ?> in<br/>
			
				<?php $title = $this->escape($this->item->category_title); ?>
				<?php if ($params->get('link_category') && $this->item->catslug) : ?>
					<?php $url = '<a href="' . JRoute::_(ContentHelperRoute::getCategoryRoute($this->item->catslug)) . '" itemprop="genre">' . $title . '</a>'; ?>
					<?php echo $url; ?>
				<?php else : ?>
						<?php echo '<span itemprop="genre">' . $title . '</span>'; ?>
				<?php endif; ?>
				</p>
			</div>
		</div>
	</div>
	<?php if ($this->params->get('show_page_heading')) : ?>
		<div class="page-header">
			<h1> <?php echo $this->escape($this->params->get('page_heading')); ?> </h1>
		</div>
	<?php endif;
	if (!empty($this->item->pagination) && $this->item->pagination && !$this->item->paginationposition && $this->item->paginationrelative) {
		echo $this->item->pagination;
	}
	?>

	<?php // Todo Not that elegant would be nice to group the params 
	?>
	<?php $useDefList = ($params->get('show_modify_date') || $params->get('show_publish_date') || $params->get('show_create_date')
		|| $params->get('show_hits') || $params->get('show_category') || $params->get('show_parent_category') || $params->get('show_author') || $assocParam); ?>

	<?php if (!$useDefList && $this->print) : ?>
		<div id="pop-print" class="btn hidden-print">
			<?php echo JHtml::_('icon.print_screen', $this->item, $params); ?>
		</div>
		<div class="clearfix"> </div>
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

	<?php // Content is generated by content plugin event "onContentAfterTitle" 
	?>
	<?php echo $this->item->event->afterDisplayTitle; ?>

	<?php if ($useDefList && ($info == 0 || $info == 2)) : ?>
		<?php // Todo: for Joomla4 joomla.content.info_block.block can be changed to joomla.content.info_block 
		?>
		<?php echo JLayoutHelper::render('joomla.content.info_block.block', array('item' => $this->item, 'params' => $params, 'position' => 'above')); ?>
	<?php endif; ?>

	<?php if ($info == 0 && $params->get('show_tags', 1) && !empty($this->item->tags->itemTags)) : ?>
		<?php $this->item->tagLayout = new JLayoutFile('joomla.content.tags'); ?>

		<?php echo $this->item->tagLayout->render($this->item->tags->itemTags); ?>
	<?php endif; ?>

	<?php // Content is generated by content plugin event "onContentBeforeDisplay" 
	?>
	<?php echo $this->item->event->beforeDisplayContent; ?>

	<?php if (
		isset($urls) && ((!empty($urls->urls_position) && ($urls->urls_position == '0')) || ($params->get('urls_position') == '0' && empty($urls->urls_position)))
		|| (empty($urls->urls_position) && (!$params->get('urls_position')))
	) : ?>
		<?php echo $this->loadTemplate('links'); ?>
	<?php endif; ?>
	<?php if ($params->get('access-view')) : ?>
		
		<?php
		if (!empty($this->item->pagination) && $this->item->pagination && !$this->item->paginationposition && !$this->item->paginationrelative) :
			echo $this->item->pagination;
		endif;
		?>
		<?php if (isset($this->item->toc)) :
			echo $this->item->toc;
		endif; ?>
		<div itemprop="articleBody">
			<?php echo $this->item->text; ?>
		</div>

		<?php if ($info == 1 || $info == 2) : ?>
			<?php if ($useDefList) : ?>
				<?php // Todo: for Joomla4 joomla.content.info_block.block can be changed to joomla.content.info_block 
				?>
				<?php echo JLayoutHelper::render('joomla.content.info_block.block', array('item' => $this->item, 'params' => $params, 'position' => 'below')); ?>
			<?php endif; ?>
			<?php if ($params->get('show_tags', 1) && !empty($this->item->tags->itemTags)) : ?>
				<?php $this->item->tagLayout = new JLayoutFile('joomla.content.tags'); ?>
				<?php echo $this->item->tagLayout->render($this->item->tags->itemTags); ?>
			<?php endif; ?>
		<?php endif; ?>

		<?php 
			$modules  = JModuleHelper::getModule("custom", "[Addon]Work with us Green");
			$document = JFactory::getDocument();
			$attribs  = array();
			$attribs['style'] = 'xhtml';
			//echo JModuleHelper::renderModule($modules, $attribs);
			
		?>
		
		<?php if (isset($urls) && ((!empty($urls->urls_position) && ($urls->urls_position == '1')) || ($params->get('urls_position') == '1'))) : ?>
			<?php echo $this->loadTemplate('links'); ?>
		<?php endif; ?>
		<?php // Optional teaser intro text for guests 
		?>
	<?php elseif ($params->get('show_noauth') == true && $user->get('guest')) : ?>
		<?php echo JLayoutHelper::render('joomla.content.intro_image', $this->item); ?>
		<?php echo JHtml::_('content.prepare', $this->item->introtext); ?>
		<?php // Optional link to let them register to see the whole article. 
		?>
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
	
	<?php // Content is generated by content plugin event "onContentAfterDisplay" 
	?>
	<?php echo $this->item->event->afterDisplayContent; ?>

	<?php foreach ($this->item->jcfields as $jcfield) {
		$this->item->jcFields[$jcfield->name] = $jcfield;
	} ?>

	<?php if (sizeof($this->item->jcFields)) { ?>
		<?php /*
		<div class="related">
			<h3 class="text-center text-strong">You may also like to see these:</h3>
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
		*/ ?>
	<?php } ?>
	<?php
		//echo $this->item->pagination;
	?>
	
</div>
