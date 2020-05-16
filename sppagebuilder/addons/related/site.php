<?php
/**
 * @package Varsita
 * @author JoomShaper http://www.joomshaper.com
 * @copyright Copyright (c) 2010 - 2015 JoomShaper
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or later
*/
//no direct accees
defined ('_JEXEC') or die ('resticted aceess');

class SppagebuilderAddonRelated extends SppagebuilderAddons {
  public function render(){
		$addon_id = 'addon' . $this->addon->id;

		$class  = (isset($this->addon->settings->class) && $this->addon->settings->class) ? $this->addon->settings->class : '';

		$output = '';

		$output  .= '<div class="sppb-addon sppb-addon-related' . $class . '">';

			$output  .= '<div id="'.$addon_id.'" class="row">';
					foreach ($this->addon->settings->sp_repetable_item as $key => $value) {
						$output .= '<div class="col-md-4">';
						$image = (isset($value->image) && $value->image) ? $value->image : '';
						$avatar = (isset($value->avatar) && $value->avatar) ? $value->avatar : 'images/logo/default-avatar.jpg';
						$title = (isset($value->title) && $value->title) ? $value->title : '';
						$subtitle = (isset($value->subtitle) && $value->subtitle) ? $value->subtitle : '';
						$url = (isset($value->url) && $value->url) ? $value->url : '';
						$readmore = (isset($value->readmore) && $value->readmore) ? $value->readmore : '';
						
						$output .= '<div class="blog-intro">';
							$output .= '<a href="'.$url.'" itemprop="url"></a>';
							$output .= '<div class="blog-intro--image">';
	
							if(JFile::exists($image) && isset($image) && !empty($image)):
								$output .= JLayoutHelper::render('joomla.content.slide_image_thumb', array($image, "750x870"));
							endif;
							$output .= '</div>';
							$output .= '<div class="overlay"></div>';
							$output .= '<div class="mask"></div>';

							$output .= '<div class="blog-intro--content">';
								$output .= '<div class="created_by d-flex flex-column align-items-center">';
									$output .= '<div class="avatar">';
										$output .= '<img class="img-fluid" alt="avatar" src="' . $avatar.'" />';
									$output .= '</div>';
								
									$output .= '<h5>';
										$output .= '<a href="'.$url.'" itemprop="url">';
										$output .= $title;
										$output .= '</a>';
									$output .= '</h5>';
									$output .= '<p>'.$subtitle.'</p>';
								$output .= '</div>';
								if($readmore){
									if($readmore == 'readmore') {
										$output .= '<p>Read More</p>';
									} elseif ($readmore == 'viewcase'){
										$output .= '<p>View Case Study</p>';
									}
								}
							$output .= '</div>';
						$output .= '</div>';
						$output .= '</div>';
					}
		$output .= '</div>';
		$output .= '</div>';

		return $output;
	}

	public function css() {
		$addon_id = '#addon' . $this->addon->id;
		$css= '';

		foreach ($this->addon->settings->sp_repetable_item as $key => $value) {
			
		}
		return $css;
	}
}