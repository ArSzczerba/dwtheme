<?php
/**
 * @package SP Page Builder
 * @author JoomShaper http://www.joomshaper.com
 * @copyright Copyright (c) 2010 - 2016 JoomShaper
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or later
*/
//no direct accees
defined ('_JEXEC') or die ('restricted aceess');

class SppagebuilderAddonStaticbanner extends SppagebuilderAddons {

    public function render() {
        $addon_id = '#sppb-addon-' . $this->addon->id;
        $title = (isset($this->addon->settings->title) && $this->addon->settings->title) ? $this->addon->settings->title : '';
        $subtitle = (isset($this->addon->settings->subtitle) && $this->addon->settings->subtitle) ? $this->addon->settings->subtitle : '';

        $class = (isset($this->addon->settings->class) && $this->addon->settings->class) ? $this->addon->settings->class : '';
        $output = '';

        $output .= '<div class="staticbanner d-flex align-items-baseline">';
            $output .= '<div class="mainbg"></div>';
            $output .= '<div class="container text-left text-white align-self-end">';
                $output .= '<p class="title">'.$title.'</p>';
                // $output .= '<h3 class="subtitle">'.$subtitle.'</h2>';
            $output .= '</div>';
        $output .= '</div>';
        return $output;
    }

    public function css() {
        $addon_id = '#sppb-addon-' .$this->addon->id;

        $css = '';
        $custom_style = '';
        $options = new stdClass;

        $options->gradient = (isset($this->addon->settings->gradient) && $this->addon->settings->gradient) ? $this->addon->settings->gradient : new stdClass();
        $options->image = (isset($this->addon->settings->image) && $this->addon->settings->image) ? $this->addon->settings->image : '';

        $radialPos = (isset($options->gradient->radialPos) && !empty($options->gradient->radialPos)) ? $options->gradient->radialPos : 'center center';

        $gradientColor = (isset($options->gradient->color) && !empty($options->gradient->color)) ? $options->gradient->color : 'rgba(17, 154, 218, 0.85)';
        $gradientColor2 = (isset($options->gradient->color2) && !empty($options->gradient->color2)) ? $options->gradient->color2 : 'rgba(134, 0, 183, 0.85)';

        $gradientDeg = (isset($options->gradient->deg) && !empty($options->gradient->deg)) ? $options->gradient->deg : '90';

        $gradientPos = (isset($options->gradient->pos) && !empty($options->gradient->pos)) ? $options->gradient->pos : '0';
        $gradientPos2 = (isset($options->gradient->pos2) && !empty($options->gradient->pos2)) ? $options->gradient->pos2 : '100';


        if(isset($options->gradient->type) && $options->gradient->type == 'radial'){
            $custom_style .= "\tbackground: radial-gradient(at " . $radialPos . ", " . $gradientColor . " " . $gradientPos . "%, " . $gradientColor2 . " " . $gradientPos2 . "%)\n";
        } else {

            $custom_style .= "\tbackground: linear-gradient(" . $gradientDeg . "deg, " . $gradientColor . " " . $gradientPos . "%, " . $gradientColor2 . " " . $gradientPos2 . "%)\n";
        }

        if($custom_style) {
            $css .= $addon_id. ' .staticbanner {' . $custom_style . '}';
        }

        if($options->image){
            //$custom_style .= ', url("' . JURI::base() . $options->image . '"); ';
            $css .= $addon_id. ' .staticbanner .mainbg{ background-image: url("' . JURI::base() . $options->image . '")}';
        }

        return $css;

    }

}
