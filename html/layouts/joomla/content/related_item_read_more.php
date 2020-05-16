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
<p class="readmore" itemprop="name">
	<a href="<?php echo JRoute::_(
		ContentHelperRoute::getArticleRoute($displayData->id, $displayData->catid, $displayData->language)
	); ?>" itemprop="url">
		Read more
	</a>
</p>

