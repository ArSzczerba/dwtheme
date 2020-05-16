<?php
/**
 * @package     Joomla.Site
 * @subpackage  mod_articles_category
 *
 * @copyright   Copyright (C) 2005 - 2018 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

?>

<?php if(sizeof($list)) { ?>
	<?php
		$item = &$list[0];
	?>
	<div class="items-leading">
		<div class="leading">
			<a href="<?php echo $item->link; ?>" itemprop="url"></a>
			<?php echo JLayoutHelper::render('joomla.content.blog_intro_image', $item); ?>
			<div class="leading-content">
				<div>
					<span class="badge badge-info">Featured</span>
				</div>
				<h2 itemprop="name">
					<?php echo $item->title; ?>
				</h2>
				<div class="created_by d-flex flex-column align-items-left">
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
						<?php $author = ($item->created_by_alias ?: $item->author); ?>
						<?php $author = '<span itemprop="name">' . $author . '</span>'; ?>
						<p><?php echo $author; ?></p>
					</div>
				</div>
			</div>

		</div>
	</div>

<?php } ?>
