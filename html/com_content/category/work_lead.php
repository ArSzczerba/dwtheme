<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_content
 *
 * @copyright   Copyright (C) 2005 - 2018 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

// Create a shortcut for params.
$params = $this->item->params;
JHtml::addIncludePath(JPATH_COMPONENT . '/helpers/html');
$canEdit = $this->item->params->get('access-edit');
$info    = $params->get('info_block_position', 0);

// Check if associations are implemented. If they are, define the parameter.
$assocParam = (JLanguageAssociations::isEnabled() && $params->get('show_associations'));

?>

<?php

$color1 = $this->item->jcfields['2']->value ? hexdec($this->item->jcfields['2']->value) : hexdec('#747474');
$color2 = $this->item->jcfields['3']->value ? hexdec($this->item->jcfields['3']->value) : hexdec('#333333');

$gradient_start_colors = array("red" => 0xFF & ($color1 >> 0x10), "green" => 0xFF & ($color1 >> 0x8), "blue" => 0xFF & $color1);
$gradient_end_colors = array("red" => 0xFF & ($color2 >> 0x10), "green" => 0xFF & ($color2 >> 0x8), "blue" => 0xFF & $color2);

$gradientColor = 'rgba('.$gradient_start_colors['red'].','.$gradient_start_colors['green'].','.$gradient_start_colors['blue'].', 0.85)';
$gradientColor2 = 'rgba('.$gradient_end_colors['red'].','.$gradient_end_colors['green'].','.$gradient_end_colors['blue'].', 0.85)';

$gradientDeg = '0';

$gradientPos = '0';
$gradientPos2 = '100';

$document = JFactory::getDocument();
// custom CSS prepare
$custom_style = "\tbackground: linear-gradient(" . $gradientDeg . "deg, " . $gradientColor2 . " " . $gradientPos . "%, " . $gradientColor . " " . $gradientPos2 . "%);\n";

if($custom_style) {
	$style = '#work'.$this->item->id.' .overlay {' . $custom_style . '}';
}

$document->addStyleDeclaration( $style );

$images = json_decode($this->item->images);
//$images->image_intro
if(isset($images->image_intro) && !empty($images->image_intro)){
	$style = '#work'.$this->item->id.' { background-image: url("'. JURI::base() . $images->image_intro.'")}';
}

$document->addStyleDeclaration( $style );
?>
<div id="work<?php echo $this->item->id; ?>" class="work_item">
<a href="<?php echo JRoute::_(
	ContentHelperRoute::getArticleRoute($this->item->slug, $this->item->catid, $this->item->language)
); ?>">
<?php if ($this->item->state == 0 || strtotime($this->item->publish_up) > strtotime(JFactory::getDate())
	|| ((strtotime($this->item->publish_down) < strtotime(JFactory::getDate())) && $this->item->publish_down != JFactory::getDbo()->getNullDate())) : ?>
	<div class="system-unpublished">
<?php endif; ?>

<?php // echo JLayoutHelper::render('joomla.content.blog_style_default_item_title', $this->item); ?>

<?php if ($canEdit || $params->get('show_print_icon') || $params->get('show_email_icon')) : ?>
	<?php echo JLayoutHelper::render('joomla.content.icons', array('params' => $params, 'item' => $this->item, 'print' => false)); ?>
<?php endif; ?>

<?php // Todo Not that elegant would be nice to group the params ?>
<?php $useDefList = ($params->get('show_modify_date') || $params->get('show_publish_date') || $params->get('show_create_date')
	|| $params->get('show_hits') || $params->get('show_category') || $params->get('show_parent_category') || $params->get('show_author') || $assocParam); ?>

<?php if ($useDefList && ($info == 0 || $info == 2)) : ?>
  <?php // Todo: for Joomla4 joomla.content.info_block.block can be changed to joomla.content.info_block ?>
	<?php echo JLayoutHelper::render('joomla.content.info_block.block', array('item' => $this->item, 'params' => $params, 'position' => 'above')); ?>
<?php endif; ?>

<?php //echo JLayoutHelper::render('joomla.content.intro_image', $this->item); ?>
<?php //echo JLayoutHelper::render('joomla.content.work_intro_image', $this->item); ?>



<?php if($params->get('show_title')){ ?>
	<div class="overlay">
		<div>
			<?php //echo JLayoutHelper::render('joomla.content.work_default_item_tags', $this->item->tags->itemTags); ?>
			<?php echo JLayoutHelper::render('joomla.content.work_default_item_title', $this->item); ?>
		</div>
		<div>
			<?php echo JLayoutHelper::render('joomla.content.work_default_item_read_more', $this->item); ?>
		</div>
	</div>
<?php } ?>

<?php if (!$params->get('show_intro')) : ?>
	<?php // Content is generated by content plugin event "onContentAfterTitle" ?>
	<?php echo $this->item->event->afterDisplayTitle; ?>
<?php endif; ?>

<?php // Content is generated by content plugin event "onContentBeforeDisplay" ?>
<?php echo $this->item->event->beforeDisplayContent; ?>

<?php echo $this->item->introtext; ?>

<?php if ($useDefList && ($info == 1 || $info == 2)) : ?>
	<?php // Todo: for Joomla4 joomla.content.info_block.block can be changed to joomla.content.info_block ?>
	<?php echo JLayoutHelper::render('joomla.content.info_block.block', array('item' => $this->item, 'params' => $params, 'position' => 'below')); ?>
	<?php if ($params->get('show_tags', 1) && !empty($this->item->tags->itemTags)) : ?>
		<?php echo JLayoutHelper::render('joomla.content.tags', $this->item->tags->itemTags); ?>
	<?php endif; ?>
<?php endif; ?>

<?php if ($params->get('show_readmore') && $this->item->readmore) :
	if ($params->get('access-view')) :
		$link = JRoute::_(ContentHelperRoute::getArticleRoute($this->item->slug, $this->item->catid, $this->item->language));
	else :
		$menu = JFactory::getApplication()->getMenu();
		$active = $menu->getActive();
		$itemId = $active->id;
		$link = new JUri(JRoute::_('index.php?option=com_users&view=login&Itemid=' . $itemId, false));
		$link->setVar('return', base64_encode(ContentHelperRoute::getArticleRoute($this->item->slug, $this->item->catid, $this->item->language)));
	endif; ?>

	<?php echo JLayoutHelper::render('joomla.content.readmore', array('item' => $this->item, 'params' => $params, 'link' => $link)); ?>

<?php endif; ?>

<?php if ($this->item->state == 0 || strtotime($this->item->publish_up) > strtotime(JFactory::getDate())
	|| ((strtotime($this->item->publish_down) < strtotime(JFactory::getDate())) && $this->item->publish_down != JFactory::getDbo()->getNullDate())) : ?>
</div>
<?php endif; ?>

<?php // Content is generated by content plugin event "onContentAfterDisplay" ?>
<?php echo $this->item->event->afterDisplayContent; ?>
</a>
</div>