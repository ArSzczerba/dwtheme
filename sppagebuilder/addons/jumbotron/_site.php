<?php
/**
 * @package SP Page Builder
 * @author JoomShaper http://www.joomshaper.com
 * @copyright Copyright (c) 2010 - 2016 JoomShaper
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or later
*/
//no direct accees
defined ('_JEXEC') or die ('restricted aceess');

class SppagebuilderAddonJumbotron extends SppagebuilderAddons{

	public function render() {
		$settings = $this->addon->settings;

		$title = (isset($settings->title) && $settings->title) ? $settings->title : '';
		$subtitle = (isset($settings->subtitle) && $settings->subtitle) ? $settings->subtitle : '';

		$class = (isset($settings->class) && $settings->class) ? $settings->class : '';
		$class .= (isset($this->addon->settings->alignment) && $this->addon->settings->alignment) ? ' ' . $this->addon->settings->alignment : '';

		$addon_id = 'sppb-addon-' . $this->addon->id;
		$output = '';

		$output .= '<div id ="'.$addon_id.'" class="sppb-addon sppb-addon-jumbotron jumbotron '. $class . '">';
			if(isset($this->addon->settings->mask_desktop) && $this->addon->settings->mask_desktop){
				$output .= '<div class="jumbotron-mask"></div>';
			}
			$output .= '<div class="container">';
			$output .= '<div class="sppb-addon-content">';
				$output .= '<h2 class="sppb-addon-title addon-title">' .$subtitle .'</h2>';
				$output .= '<h1 class="sppb-addon-title addon-title mb-4">' .nl2br($title) .'</h1>';
				$output .= $this->renderButtons();
			$output .= '</div>';
			$output .= '</div>';
		$output .= '</div>';
		
		return $output;
	}

	
	public function css() {
		$addon_id = '#sppb-addon-' . $this->addon->id;
		$settings = $this->addon->settings;

		$image_desktop = (isset($this->addon->settings->image_desktop) && $this->addon->settings->image_desktop) ? $this->addon->settings->image_desktop : '';
		$mask_desktop = (isset($this->addon->settings->mask_desktop) && $this->addon->settings->mask_desktop) ? $this->addon->settings->mask_desktop : '';
		$image_mobile = (isset($this->addon->settings->image_mobile) && $this->addon->settings->image_mobile) ? $this->addon->settings->image_mobile : '';

		$css = '';
		
		if($image_mobile){
			$css .= '@media screen and (max-width: 767px){'. $addon_id .' { background-image: url("'. JURI::base() . '/' .$image_mobile.'")}}';
		}
		if($image_desktop){
			$css .= '@media screen and (min-width: 768px){'. $addon_id .' { background-image: url("'. JURI::base() . '/' .$image_desktop.'")}}';
		}
		if($mask_desktop){
			$css .= '@media screen and (min-width: 768px){'. $addon_id .' .jumbotron-mask { background-image: url("'. JURI::base() . '/' .$mask_desktop.'")}}';
		}

		$title_style = '';
		
		$title_style .= (isset($settings->title_text_color) && $settings->title_text_color) ? 'color: ' . $settings->title_text_color . ';' : '';

		if($title_style){
			$css .= $addon_id . ' h1,  '. $addon_id . ' h2  {';
                $css .= $title_style;
			$css .= '}';
		}

		// echo $css;
		// die();
		
		return $css;
	}

	public function renderButtons(){
		$settings = $this->addon->settings;
		
		$html = '';

		$html = '<div class="sppb-addon sppb-addon-button-group">';
			$html .= '<div class="sppb-addon-content">';

				if (isset($this->addon->settings->sp_button_group_item) && count((array) $this->addon->settings->sp_button_group_item)) {

					foreach ($this->addon->settings->sp_button_group_item as $key => $value) {
						if ($value->title || $value->icon) {
							$class = (isset($value->type) && $value->type) ? ' sppb-btn-' . $value->type : '';
							$type = (isset($value->type) && $value->type) ? $value->type : '';
							$class .= (isset($value->size) && $value->size) ? ' sppb-btn-' . $value->size : '';
							$class .= (isset($value->block) && $value->block) ? ' ' . $value->block : '';
							$class .= (isset($value->shape) && $value->shape) ? ' sppb-btn-' . $value->shape : ' sppb-btn-rounded';
							$class .= (isset($value->appearance) && $value->appearance) ? ' sppb-btn-' . $value->appearance : '';
							$attribs = (isset($value->target) && $value->target) ? ' rel="noopener noreferrer" target="' . $value->target . '"' : '';
							$attribs .= (isset($value->url) && $value->url) ? ' href="' . $value->url . '"' : '';
							$attribs .= ' id="btn-' . ($this->addon->id + $key) . '"';
							$text = (isset($value->title) && $value->title) ? $value->title : '';
							$icon = (isset($value->icon) && $value->icon) ? $value->icon : '';
							$icon_position = (isset($value->icon_position) && $value->icon_position) ? $value->icon_position : 'left';
							$ctacolor = (isset($value->ctacolor) && $value->ctacolor) ? $value->ctacolor : 'default';

							if ($icon_position == 'left') {
									$text = ($icon) ? '<i class="fa ' . $icon . '" aria-hidden="true"></i> ' . $text : $text;
							} else {
									$text = ($icon) ? $text . ' <i class="fa ' . $icon . '" aria-hidden="true"></i>' : $text;
							}

							if($type == "cta"){
								$html .= '<a' . $attribs . ' class="sppb-btn btn-'.$ctacolor.' ' . $class . '"><span class="text">' . $text . '</span><span class="line -right"></span><span class="line -top"></span><span class="line -left"></span><span class="line -bottom"></span></a>';
							} else {
								$html .= '<a' . $attribs . ' class="sppb-btn ' . $class . '">' . $text . '</a>';
							}
						}
					}
				}

			$html .= '</div>';
		$html .= '</div>';

		return $html;
	}

}
