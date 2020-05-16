<?php

/**
 * @package     Joomla.Site
 * @subpackage  com_tags
 *
 * @copyright   Copyright (C) 2005 - 2019 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

JHtml::_('behavior.core');
JHtml::_('formbehavior.chosen', 'select');

// Get the user object.
$user = JFactory::getUser();

// Check if user is allowed to add/edit based on tags permissions.
// Do we really have to make it so people can see unpublished tags???
$canEdit      = $user->authorise('core.edit', 'com_tags');
$canCreate    = $user->authorise('core.create', 'com_tags');
$canEditState = $user->authorise('core.edit.state', 'com_tags');

JFactory::getDocument()->addScriptDeclaration("
		var resetFilter = function() {
		document.getElementById('filter-search').value = '';
	}
");

?>

	<?php if ($this->params->get('show_headings') || $this->params->get('filter_field') || $this->params->get('show_pagination_limit')) : ?>
		
	<?php endif; ?>
	<?php if (empty($this->items)) : ?>
		<p><?php echo JText::_('COM_TAGS_NO_ITEMS'); ?></p>
	<?php else : ?>
		<?php
			$introcount = count($this->items);
			$counter = 0;
		?>
		<?php foreach ($this->items as $key => &$item) : ?>
			
			<?php $this->columns = 2; ?>
			<?php $rowcount = ((int) $key % (int) $this->columns) + 1; ?>
			<?php if ($rowcount === 1) : ?>
				<?php $row = $counter / $this->columns; ?>
				<div class="items-row cols-<?php echo (int) $this->columns; ?> <?php echo 'row-' . $row; ?> row clearfix">
				<?php endif; ?>
				<div class="col-md-<?php echo round(12 / $this->columns); ?>">
					<div class="item column-<?php echo $rowcount; ?><?php echo $item->state == 0 ? ' system-unpublished' : null; ?>" itemprop="blogPost" itemscope itemtype="https://schema.org/BlogPosting">
						<?php $this->item = &$item; ?>
		
						<div class="blog-intro">
							<a href="<?php echo JRoute::_($item->link); ?>" itemprop="url"></a>
							<?php $images = json_decode($item->core_images); ?>
							<?php $image = htmlspecialchars($images->image_intro, ENT_COMPAT, 'UTF-8'); ?>
							<div class="blog-intro--image">
								<?php echo JLayoutHelper::render('joomla.content.slide_image_thumb', array($image, "750x870")); ?>
							</div>

							<div class="overlay"></div>
							<div class="mask"></div>
							<div class="blog-intro--content">
								<div class="created_by d-flex flex-column align-items-center">
									<div class="avatar">
										<?php JLoader::register('FieldsHelper', JPATH_ADMINISTRATOR . '/components/com_fields/helpers/fields.php');
											$fields = FieldsHelper::getFields('com_users.user',  JFactory::getUser($item->created_by));
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
										<?php $author = '<span itemprop="name">' . $item->jcfields[2]->author_name . '</span>'; ?>
										<p><?php //echo $author; ?></p>
									</div>
								
								<?php echo JLayoutHelper::render('joomla.content.tag_style_default_item_intro_title', $this->item); ?>
								<p><?php //echo JHtml::_('date', $this->item->core_publish_up, JText::_('DATE_FORMAT_LC3')); ?></p>
								</div>
							</div>
						</div>
					</div>
					<!-- end item -->
					<?php $counter++; ?>
					</div><!-- end col -->
				<?php if (($rowcount == $this->columns) or ($counter == $introcount)) : ?>
				</div><!-- end row -->
			<?php endif; ?>
		<?php endforeach; ?>
		

		<?php endif; ?>