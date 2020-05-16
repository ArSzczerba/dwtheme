<?php
/**
 * @package SP Page Builder
 * @author JoomShaper http://www.joomshaper.com
 * @copyright Copyright (c) 2010 - 2016 JoomShaper
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or later
*/
//no direct accees
defined ('_JEXEC') or die ('restricted aceess');

class SppagebuilderAddonWork extends SppagebuilderAddons{

	public function render() {
		$settings = $this->addon->settings;
		$title = (isset($settings->title) && $settings->title) ? $settings->title : '';
		$desc = (isset($settings->desc) && $settings->desc) ? $settings->desc : '';
		$bg = (isset($settings->bg) && $settings->bg) ? $settings->bg : ''; 
		$button_url = (isset($settings->button_url) && $settings->button_url) ? $settings->button_url : '';
		$size = (isset($settings->size) && $settings->size) ? $settings->size : '1';
		$class = (isset($settings->class) && $settings->class) ? $settings->class : '';
		

		//Output
		$output  = '';
		

		$output .= '<div class="sppb-addon sppb-addon-work grid'. $size . ' '. $class . '">';
		if($button_url){
			$output .= '<a href="'. $button_url .'" class="sppb-btn sppb-btn-fullbox"></a>';
		}
		$output .= '<img class="img-fluid" src="'.$bg.'" />';
		$output .= '<div class="sppb-addon-content">';
			$output .= '<h3>'.$title.'</h3>';
			$output .= '<p>'.$desc.'</p>';
		$output .= '</div>';
		$output .= '</div>';

		return $output;
	}


}
