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

JHtml::_('behavior.caption');

$dispatcher = JEventDispatcher::getInstance();

$this->category->text = $this->category->description;
$dispatcher->trigger('onContentPrepare', array($this->category->extension . '.categories', &$this->category, &$this->params, 0));
$this->category->description = $this->category->text;

$results = $dispatcher->trigger('onContentAfterTitle', array($this->category->extension . '.categories', &$this->category, &$this->params, 0));
$afterDisplayTitle = trim(implode("\n", $results));

$results = $dispatcher->trigger('onContentBeforeDisplay', array($this->category->extension . '.categories', &$this->category, &$this->params, 0));
$beforeDisplayContent = trim(implode("\n", $results));

$results = $dispatcher->trigger('onContentAfterDisplay', array($this->category->extension . '.categories', &$this->category, &$this->params, 0));
$afterDisplayContent = trim(implode("\n", $results));

?>

	<?php if ($this->params->get('show_page_heading')) : ?>
		<div class="page-header">
			<h1> <?php echo $this->escape($this->params->get('page_heading')); ?> </h1>
		</div>
	<?php endif; ?>

	<?php if ($this->params->get('show_category_title', 1) or $this->params->get('page_subheading')) : ?>
		<h2> <?php echo $this->escape($this->params->get('page_subheading')); ?>
			<?php if ($this->params->get('show_category_title')) : ?>
				<span class="subheading-category"><?php echo $this->category->title; ?></span>
			<?php endif; ?>
		</h2>
	<?php endif; ?>
	<?php echo $afterDisplayTitle; ?>

	<?php if ($this->params->get('show_cat_tags', 1) && !empty($this->category->tags->itemTags)) : ?>
		<?php $this->category->tagLayout = new JLayoutFile('joomla.content.tags'); ?>
		<?php echo $this->category->tagLayout->render($this->category->tags->itemTags); ?>
	<?php endif; ?>

	<?php if ($beforeDisplayContent || $afterDisplayContent || $this->params->get('show_description', 1) || $this->params->def('show_description_image', 1)) : ?>
		<div class="category-desc clearfix">
			<?php if ($this->params->get('show_description_image') && $this->category->getParams()->get('image')) : ?>
				<img src="<?php echo $this->category->getParams()->get('image'); ?>" alt="<?php echo htmlspecialchars($this->category->getParams()->get('image_alt'), ENT_COMPAT, 'UTF-8'); ?>"/>
			<?php endif; ?>
			<?php echo $beforeDisplayContent; ?>
			<?php if ($this->params->get('show_description') && $this->category->description) : ?>
				<?php echo JHtml::_('content.prepare', $this->category->description, '', 'com_content.category'); ?>
			<?php endif; ?>
			<?php echo $afterDisplayContent; ?>
		</div>
	<?php endif; ?>

	<?php if (empty($this->lead_items) && empty($this->link_items) && empty($this->intro_items)) : ?>
		<?php if ($this->params->get('show_no_articles', 1)) : ?>
			<p><?php echo JText::_('COM_CONTENT_NO_ARTICLES'); ?></p>
		<?php endif; ?>
	<?php endif; ?>

	<?php $leadingcount = 0; ?>
	<?php if (!empty($this->lead_items)) : ?>
		<div class="section  article-swiper-container" data-header-class="primary-color">

			<div class="h-100 py-5 d-flex align-items-center justify-content-center flex-column">
					<div class="container">
						<div class="section-header">
							<h2>Work.<br/> See what we do.</h2>
						</div>
					</div>

					<div class="article-swiper">
						<div class="work-container clearfix">
							<div class="swiper-container " data-swiper-slidesPerView="auto" data-swiper-slidesPerColumn="1" data-swiper-loop="true" >
								<div class="swiper-wrapper">
									<?php foreach ($this->lead_items as &$item) : ?>
										<?php
											echo '<div class="swiper-slide"><div class="swiper-item work item">';
											$this->item = &$item;
											echo $this->loadTemplate('lead');
											echo '</div></div>';
										?>
										<?php $leadingcount++; ?>
									<?php endforeach; ?>
								</div>
							</div>
						</div>

						<div class="container text-center d-flex justify-content-center">
							<div class="swiper-arrow swiper-button-prev"><img src="images/right.svg" alt="" /></div>
							<div class="swiper-arrow swiper-button-next"><img src="images/right.svg" alt="" /></div>
						</div>
					</div>

					<?php
						$jumbotron  = JModuleHelper::getModules("work-load-more");
						$document = JFactory::getDocument();
						$attribs  = array();
						$attribs['style'] = 'xhtml';
						echo JModuleHelper::renderModule($jumbotron[0], $attribs);

					?>
					<a class="switchview">Change to view as list</a>
					<!--<a class="loadmore" data-limit="400" data-start="6" data-category="8">Load More</a>-->
			</div>


		</div><!-- end items-leading -->

	<?php endif; ?>

	<?php
	$introcount = count($this->intro_items);
	$counter = 0;
	?>

	<?php
		$jumbotron = false;
		// $jumbotron  = JModuleHelper::getModules("jumbotron");
		// $document = JFactory::getDocument();
		// $attribs  = array();
		// $attribs['style'] = 'xhtml';
		//echo JModuleHelper::renderModule($jumbotron[0], $attribs);



	?>

	<?php if (false && !empty($this->intro_items)) : ?>
		<?php foreach ($this->intro_items as $key => &$item) : ?>
			<?php $rowcount = ((int) $key % (int) $this->columns) + 1; ?>
			<?php if ($rowcount === 1) : ?>
				<?php $row = $counter / $this->columns; ?>

				<div class="section <?php echo ($row == $rowcount) ? "fp-auto-height" : "" ?> cols-<?php echo (int) $this->columns; ?> <?php echo 'row-' .
				$row; ?> clearfix">
					<div class="work-inner pt-6 pb-5">
			<?php endif; ?>

				<div id="article<?php echo $item->id;?>" class="item work column-<?php echo $rowcount; ?><?php echo $item->state == 0 ? ' system-unpublished' : null; ?>"
					itemprop="blogPost" itemscope itemtype="https://schema.org/BlogPosting">
					<?php
					$this->item = &$item;
					//echo $this->loadTemplate('item');
					?>

				</div>
				<!-- end item -->
			<?php $counter++; ?>

			<?php if (($rowcount == $this->columns) or ($counter == $introcount)) : ?>
			<div class="dw-next gray"><a href="#"><i class="fa fa-chevron-down"></i></a></div>
			</div></div><!-- end row -->
			<?php endif; ?>
		<?php endforeach; ?>
	<?php endif; ?>



