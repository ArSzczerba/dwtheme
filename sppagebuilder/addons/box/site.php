<?php
/**
 * @package SP Page Builder
 * @author JoomShaper http://www.joomshaper.com
 * @copyright Copyright (c) 2010 - 2016 JoomShaper
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or later
*/
//no direct accees
defined ('_JEXEC') or die ('restricted aceess');

class SppagebuilderAddonBox extends SppagebuilderAddons{

	public function render() {
		$settings = $this->addon->settings;
		$title = (isset($settings->title) && $settings->title) ? $settings->title : '';
		$subtitle = (isset($settings->subtitle) && $settings->subtitle) ? $settings->subtitle : '';
		$bg = (isset($settings->bg) && $settings->bg) ? $settings->bg : ''; 
		$mobile_bg = (isset($settings->mobile_bg) && $settings->mobile_bg) ? $settings->mobile_bg : ''; 
		$button_title = (isset($settings->button_title) && $settings->button_title) ? $settings->button_title : 'Read More';
		$button_url = (isset($settings->url) && $settings->url) ? $settings->url : '';
		$attribs = (isset($settings->target) && $settings->target) ? ' rel="noopener noreferrer" target="' . $settings->target . '"' : '';
		$video_button_title = (isset($settings->video_button_title) && $settings->video_button_title) ? $settings->video_button_title : 'Watch Now';

		//Options
		$video_url = (isset($settings->video_url) && $settings->video_url) ? $settings->video_url : '';
		$no_cookie = (isset($settings->no_cookie) && $settings->no_cookie) ? $settings->no_cookie : 0;
		$show_rel_video = (isset($settings->show_rel_video) && $settings->show_rel_video) ? '&rel=0' : '&rel=1';

		$mp4_enable = (isset($settings->mp4_enable) && $settings->mp4_enable) ? $settings->mp4_enable : 0;
		$video_mute = (isset($settings->video_mute) && $settings->video_mute) ? $settings->video_mute : 0;

		$mp4_video = (isset($settings->mp4_video) && $settings->mp4_video) ? $settings->mp4_video : '';
		if($mp4_video && (strpos($settings->mp4_video, "http://") !== false || strpos($settings->mp4_video, "https://") !== false)){
			$mp4_video = $settings->mp4_video;
		} else {
			if(!empty($mp4_video)){
				$mp4_video = JURI::base(true) . '/' . $settings->mp4_video;
			}
		}

		$ogv_video = (isset($settings->ogv_video) && $settings->ogv_video) ? $settings->ogv_video : '';
		if($ogv_video && (strpos($settings->ogv_video, "http://") !== false || strpos($settings->ogv_video, "https://") !== false)){
			$ogv_video = $settings->ogv_video;
		} else {
			if(!empty($ogv_video)){
				$ogv_video = JURI::base(true) . '/' . $settings->ogv_video;
			}
		}

		$show_control = (isset($settings->show_control) && $settings->show_control) ? $settings->show_control : 0;
		$video_loop = (isset($settings->video_loop) && $settings->video_loop) ? $settings->video_loop : 0;
		$autoplay_video = (isset($settings->autoplay_video) && $settings->autoplay_video) ? $settings->autoplay_video : 0;
		$video_poster = (isset($settings->video_poster) && $settings->video_poster) ? $settings->video_poster : '';
		if($video_poster && (strpos($settings->video_poster, "http://") !== false || strpos($settings->video_poster, "https://") !== false)){
			$video_poster = $settings->video_poster;
		} else {
			if(!empty($video_poster)){
				$video_poster = JURI::base(true) . '/' . $settings->video_poster;
			}
		}

		$class = (isset($settings->class) && $settings->class) ? $settings->class : '';
		

		//Output
		$output  = '';
		$src = '';
		$modal_unique_id = 'sppb-modal-' . $this->addon->id;

		if($video_url) {
			$video = parse_url($video_url);

			$youtube_no_cookie = $no_cookie ? '-nocookie' : '';

			switch($video['host']) {
				case 'youtu.be':
				$id = trim($video['path'],'/');
				$src = '//www.youtube'.$youtube_no_cookie.'.com/embed/' . $id .'?iv_load_policy=3'.$show_rel_video;
				break;

				case 'www.youtube.com':
				case 'youtube.com':
				parse_str($video['query'], $query);
				$id = $query['v'];
				$src = '//www.youtube'.$youtube_no_cookie.'.com/embed/' . $id .'?iv_load_policy=3'.$show_rel_video;
				break;

				case 'vimeo.com':
				case 'www.vimeo.com':
				$id = trim($video['path'],'/');
				$src = "//player.vimeo.com/video/{$id}";
			}
		}

		$output .= '<div class="sppb-addon sppb-addon-box effect-zoe '. $class . '">';
		$output .= '<div class="sppb-addon-inner">';
		// prepare popup if video is avaliable.
		if($video_url){
			if($mp4_enable != 1){
				$url = $video_url;
				$attribs = 'data-popup_type="iframe" data-mainclass="mfp-no-margins mfp-with-zoom"';
			} else {
				if($mp4_video || $ogv_video){
					$output .= '<div class="sppb-addon-video-local-video-wrap">';
					$output .= '<video class="sppb-addon-video-local-source"'.($video_loop != 0 ? ' loop' : '').''.($autoplay_video!=0 ? ' autoplay' : '').''.($show_control!=0 ? ' controls' : '').''.($video_mute ? ' muted' : '').' poster="'.$video_poster.'" controlsList="nodownload" playsinline>';
					if(!empty($mp4_video)){
						$output .= '<source src="'.$mp4_video.'" type="video/mp4">';
					}
					if(!empty($ogv_video)){
						$output .= '<source src="'.$ogv_video.'" type="video/ogg">';
					}
					$output .= '</video>';
					$output .= '</div>';
				}
			}
		}
			if(!$mobile_bg){
			$output .= '<img class="img-fluid" src="'.$bg.'" alt="'.$title.'" />';
			} else {
				$output .= '<img class="img-fluid d-none d-md-block" src="'.$bg.'" alt="'.$title.'" />';
				$output .= '<img class="img-fluid d-block d-md-none" src="'.$mobile_bg.'" alt="'.$title.'" />';
			}
			if($title || $subtitle || $button_url || $url){
			$output .= '<div class="sppb-addon-content">';
				if($title || $subtitle){
					$output .= '<div class="box-title">';
						if($title){
							$output .= '<h3 class="text-white">'.$title.'</h3>';
						}
						if($subtitle){
							$output .= '<p>'.$subtitle.'</p>';
						}
					$output .= '</div>';
				}
				
				$output .= '<div class="buttons">';
					if($video_url){
						$output .= '<a class="sppb-btn sppb-btn-cta btn-white ' . $class . ' sppb-magnific-popup sppb-modal-selector" '. $attribs .' href="'. $url . '" id="'. $modal_unique_id .'-selector"><span class="text">'.$video_button_title.'</span><span class="line -right"></span><span class="line -top"></span><span class="line -left"></span><span class="line -bottom"></span></a>';
					} 
					if($button_url){
						$output .= '<a '.$attribs.' href="'. $button_url .'" class="sppb-btn sppb-btn-cta btn-white ' . $class . '"><span class="text">' . $button_title . '</span><span class="line -right"></span><span class="line -top"></span><span class="line -left"></span><span class="line -bottom"></span></a>';
					}
				$output .= '</div>';
			$output .= '</div>';
				}
				$output .= '</div>';
		$output .= '</div>';

		return $output;
	}

	public function scripts() {
		return array(JURI::base(true) . '/components/com_sppagebuilder/assets/js/jquery.magnific-popup.min.js');
	}

	public function stylesheets() {
		return array(JURI::base(true) . '/components/com_sppagebuilder/assets/css/magnific-popup.css');
	}


}
