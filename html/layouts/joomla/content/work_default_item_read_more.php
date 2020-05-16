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

<div>
<!-- <a href="<?php echo JRoute::_(
	ContentHelperRoute::getArticleRoute($displayData->slug, $displayData->catid, $displayData->language)
); ?>" class="btn read-more-btn">View Work</a> -->
<span class="btn read-more-btn">View Work</span>
</div>