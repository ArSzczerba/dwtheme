<?php
/**
 * @package     Joomla.Site
 * @subpackage  Layout
 *
 * @copyright   Copyright (C) 2005 - 2018 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('JPATH_BASE') or die;

use Joomla\Registry\Registry;

JLoader::register('TagsHelperRoute', JPATH_BASE . '/components/com_tags/helpers/route.php');

$authorised = JFactory::getUser()->getAuthorisedViewLevels();

?>

<?php if (!empty($displayData)) : ?>
	<ul class="tags-list-intro work">
		<?php foreach ($displayData as $i => $tag) : ?>
			<?php if (in_array($tag->access, $authorised)) : ?>
			<?php
				switch($tag->title){
					case "Design":
						echo '<li class="tag-item" itemprop="keywords">'.$this->escape($tag->title).'<span class="dot design">.</span></li>';
					break;
					case "Print":
						echo '<li class="tag-item" itemprop="keywords">'.$this->escape($tag->title).'<span class="dot print">.</span></li>';
					break;
					case "Digital":
						echo '<li class="tag-item" itemprop="keywords">'.$this->escape($tag->title).'<span class="dot digital">.</span></li>';
					break;
				}
			?>
			<?php endif; ?>

		<?php endforeach; ?>
	</ul>
<?php endif; ?>
