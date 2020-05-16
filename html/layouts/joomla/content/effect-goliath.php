<?php
/**
 * @package     Joomla.Site
 * @subpackage  Layout
 *
 * @copyright   Copyright (C) 2005 - 2018 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('JPATH_BASE') or die;
$params = $displayData->params;
?>
<?php $images = json_decode($displayData->images); ?>

<figure class="effect-goliath">
	<div class="related-bg" style="background-image: url('<?php echo htmlspecialchars($images->image_intro, ENT_COMPAT, 'UTF-8'); ?>')">
	<?php /*
<img
	<?php if ($images->image_intro_caption) : ?>
		<?php echo 'class="caption"' . ' title="' . htmlspecialchars($images->image_intro_caption) . '"'; ?>
	<?php endif; ?>
	src="<?php echo htmlspecialchars($images->image_intro, ENT_COMPAT, 'UTF-8'); ?>" alt="<?php echo htmlspecialchars($images->image_intro_alt, ENT_COMPAT, 'UTF-8'); ?>" itemprop="thumbnailUrl"/> */ ?>
	<img src="<?php echo JURI::base() .'images/poster.png'; ?>" />
	</div>
	<figcaption>
		<p><?php echo $displayData->goliathTitle; ?></p>
		<a href="<?php echo JRoute::_(
		ContentHelperRoute::getArticleRoute($displayData->id, $displayData->catid, $displayData->language)
	); ?>" itemprop="url">
		Read more
	</a>
	</figcaption>
</figure>