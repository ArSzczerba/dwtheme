<?php
/**
 * @package SP Page Builder
 * @author JoomShaper http://www.joomshaper.com
 * @copyright Copyright (c) 2010 - 2016 JoomShaper
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or later
*/
//no direct accees
defined ('_JEXEC') or die ('restricted aceess');

class SppagebuilderAddonAbsolute extends SppagebuilderAddons{

	public function render() {

		$class = (isset($this->addon->settings->class) && $this->addon->settings->class) ? $this->addon->settings->class : '';
		$title = (isset($this->addon->settings->title) && $this->addon->settings->title) ? $this->addon->settings->title : '';
		$heading_selector = (isset($this->addon->settings->heading_selector) && $this->addon->settings->heading_selector) ? $this->addon->settings->heading_selector : 'h3';

		//Options
		$image = (isset($this->addon->settings->image) && $this->addon->settings->image) ? $this->addon->settings->image : '';
		$alt_text = (isset($this->addon->settings->alt_text) && $this->addon->settings->alt_text) ? $this->addon->settings->alt_text : '';
		$position = (isset($this->addon->settings->position) && $this->addon->settings->position) ? $this->addon->settings->position : '';
		$link = (isset($this->addon->settings->link) && $this->addon->settings->link) ? $this->addon->settings->link : '';
		$target = (isset($this->addon->settings->target) && $this->addon->settings->target) ? 'target="' . $this->addon->settings->target . '"' : '';
		$open_lightbox = (isset($this->addon->settings->open_lightbox) && $this->addon->settings->open_lightbox) ? $this->addon->settings->open_lightbox : 0;
		$image_overlay = (isset($this->addon->settings->overlay_color) && $this->addon->settings->overlay_color) ? 1 : 0;

		$output = '';

		if($image) {
			$output  .= '<div class="sppb-addon sppb-addon-absolute-image ' . $position . ' ' . $class . '">';
			$output  .= '<div class="sppb-addon-content">';
			$output  .= '<img class="sppb-img-fluid" src="' . $image . '" alt="'. $alt_text .'">';
			$output  .= '</div>';
			$output  .= '</div>';
		}

		return $output;
	}

}
