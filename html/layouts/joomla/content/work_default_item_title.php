<?php
/**
 * @package     Joomla.Site
 * @subpackage  Layout
 *
 * @copyright   Copyright (C) 2005 - 2018 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('JPATH_BASE') or die;

// Create a shortcut for params.
$params = $displayData->params;
$canEdit = $displayData->params->get('access-edit');
JHtml::addIncludePath(JPATH_COMPONENT.'/helpers/html');
?>


	<?php if(false && isset($displayData->jcfields['1']->value) && !empty($displayData->jcfields['1']->value)){ ?>
	<p><?php echo $displayData->jcfields['1']->value ?></p>
	<?php } ?>
	<h2 itemprop="name">
	<?php if ($params->get('link_titles') && ($params->get('access-view') || $params->get('show_noauth', '0') == '1')) : ?>
			<!-- <a href="<?php echo JRoute::_(
				ContentHelperRoute::getArticleRoute($displayData->slug, $displayData->catid, $displayData->language)
			); ?>" itemprop="url"> -->
				<?php echo $this->escape($displayData->title); ?>
			<!-- </a> -->
		<?php else : ?>
			<?php echo $this->escape($displayData->title); ?>
		<?php endif; ?>
</h2>

