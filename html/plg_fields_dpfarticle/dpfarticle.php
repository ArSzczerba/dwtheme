<?php
/**
 * @package     Joomla.Plugin
 * @subpackage  Fields.Media
 *
 * @copyright   Copyright (C) 2005 - 2016 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */
defined('_JEXEC') or die;

$value = $field->value;

if ($value == '') {
	return;
}

JLoader::import('joomla.application.component.model');
JModelLegacy::addIncludePath(JPATH_BASE . '/components/com_content/models', 'ContentModel');
$model = JModelLegacy::getInstance('Article', 'ContentModel', array('ignore_request' => true));
$model->setState('params', new \Joomla\Registry\Registry());
$model->setState('filter.published', 1);

// If the article is not found an error is thrown we need to hold the old error handler
$errorHandler = JError::getErrorHandling(E_ERROR);

// Ignoring all errors
JError::setErrorHandling(E_ERROR, 'ignore');

// Fetching the article
$article = $model->getItem($value);

// Restore the old error handler
JError::setErrorHandling(E_ERROR, $errorHandler['mode'], $errorHandler['options']);

if ($article instanceof JException) {
	return;
}
?>
<?php $link = JRoute::_(ContentHelperRoute::getArticleRoute($article->id, $article->catid, $article->language)); ?>
<div class="blog-intro">
	<a href="<?php echo $link; ?>" itemprop="url"></a>
	<?php if ($fieldParams->get('show_intro_image', 1)) { ?>
		<?php //echo JLayoutHelper::render('joomla.content.related-item', $article); ?>
		
		<?php 
			$images = json_decode($article->images);
			$image = htmlspecialchars($images->image_intro, ENT_COMPAT, 'UTF-8');
		?>
		<div class="blog-intro--image">
	
			<?php if(JFile::exists($image) && isset($image) && !empty($image)): ?>
			
			<?php echo JLayoutHelper::render('joomla.content.slide_image_thumb', array($image, "750x870")); ?>
			<?php endif; ?>
		</div>
		<?php } ?>

		<div class="overlay"></div>
		<div class="mask"></div>

		<div class="blog-intro--content">
			<div class="created_by d-flex flex-column align-items-center">
				<div class="avatar">
					<?php JLoader::register('FieldsHelper', JPATH_ADMINISTRATOR . '/components/com_fields/helpers/fields.php');
						$fields = FieldsHelper::getFields('com_users.user',  JFactory::getUser($article->created_by));
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
					<?php $author = ($article->created_by_alias ?: $article->author); ?>
					<?php $author = '<span itemprop="name">' . $author . '</span>'; ?>
					<!-- <p><?php echo $author; ?></p> -->
				</div>
				<h5 itemprop="name">
					<a href="<?php echo $link; ?>" itemprop="url">
						<?php echo $article->title;?>
					</a>
				</h5>
					<!-- <p><?php echo JHtml::_('date', $article->publish_up, JText::_('DATE_FORMAT_LC3')); ?></p> -->
			</div>
			
		
		</div>
</div>
