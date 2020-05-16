<?php
/**
 * @package     Joomla.Site
 * @subpackage  Layout
 *
 * @copyright   Copyright (C) 2005 - 2019 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('JPATH_BASE') or die;
$image = $displayData[0];
?>
<?php 
	$layoutOptions = empty($options) ? new JInput : new JInput($options);
	$imagePath = JPATH_SITE . '/' . ltrim($image, '/');
	$resolution   = $displayData[1] ? $displayData[1] : '750x870';
	$forcePng     = $layoutOptions->getBoolean('force_png', false);
	$rewriteThumb = $layoutOptions->getBoolean('force_rewrite', false);
	$thumbMethod  = $layoutOptions->getInt('thumb_method', JImage::SCALE_FIT);
	$fileInfo =    pathinfo($imagePath);
	$thumbPath = dirname($imagePath) . '/thumbs/' . $resolution . '/' . $fileInfo['filename'] . '.png';
	if (!$rewriteThumb && file_exists($thumbPath)){
			echo '<img class="img-responsive" data-master="'.$image.'" src="'.str_replace(JPATH_SITE, JUri::root(true), $thumbPath).'" alt="" />';
			return;
	}
	$pngPath = dirname($imagePath) . '/' . $fileInfo['filename'] . '.png';
	if ($forcePng && $fileInfo['extension'] != 'png' && !file_exists($pngPath)){
		$pngImage = imagecreatefromstring(file_get_contents($imagePath));	
		imagepng($pngImage, $pngPath);
		$jimage = new JImage($pngPath);
	} else {
			$jimage = new JImage($imagePath);
	}

	try{
		$thumbs = $jimage->generateThumbs(array($resolution), 5);
	} catch (Exception $e){
		$thumbs = array();
	}

	if (!$thumbs) {
			echo $image;
			return;
	}

	// Try to create the thumb folder
	if (!is_dir(dirname($thumbPath)) && !mkdir(dirname($thumbPath), 0755, true)){
			echo $image;
			return;
	}

	$thumbs[0]->toFile($thumbPath, JImage::getImageFileProperties($jimage->getPath())->type);
?>
<img class="img-responsive" data-master="<?php echo $image; ?>" src="<?php 	echo str_replace(JPATH_SITE, JUri::root(true), $thumbPath);?>" alt="" />