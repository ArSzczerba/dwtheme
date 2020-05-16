<?php
/**
* @package SP Page Builder
* @author JoomShaper http://www.joomshaper.com
* @copyright Copyright (c) 2010 - 2016 JoomShaper
* @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or later
*/
//no direct accees
defined ('_JEXEC') or die ('restricted aceess');

SpAddonsConfig::addonConfig(
	array(
		'type'=>'content',
		'addon_name'=>'sp_service',
		'title'=>JText::_('DW Service Box'),
		'desc'=>JText::_('Text Box with image'),
		'category'=>'DW',
		'attr'=>array(
			'general' => array(
				'admin_label'=>array(
					'type'=>'text',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_ADMIN_LABEL'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_ADMIN_LABEL_DESC'),
					'std'=> ''
				),

				'title' => array(
					'type' => 'text',
					'title' => JText::_('COM_SPPAGEBUILDER_ADDON_CAROUSEL_ITEM_TITLE'),
					'std' => '',
				),

				'content' => array(
					'type' => 'editor',
					'title' => JText::_('COM_SPPAGEBUILDER_ADDON_CAROUSEL_ITEM_CONTENT'),
					'desc' => JText::_('COM_SPPAGEBUILDER_ADDON_CAROUSEL_ITEM_CONTENT_DESC'),
					'std' => ''
				),

				'background_color' => array(
					'type' => 'color',
					'title' => JText::_('Background Color'),
					'desc' => JText::_(''),
					'std' => '#F2F2F2',
				),

				'bg'=>array(
					'type' => 'media',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_FEATURE_BOX_IMAGE'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_FEATURE_BOX_IMAGE_DESC'),
					'std' => '',
				),

				'alignment' => array(
					'type' => 'select',
					'title' => JText::_('COM_SPPAGEBUILDER_ADDON_GLOBAL_CONTENT_ALIGNMENT'),
					'desc' => JText::_('COM_SPPAGEBUILDER_ADDON_GLOBAL_CONTENT_ALIGNMENT_DESC'),
					'values' => array(
							'left' => JText::_('COM_SPPAGEBUILDER_GLOBAL_LEFT'),
							'right' => JText::_('COM_SPPAGEBUILDER_GLOBAL_RIGHT'),
							'bottom' => JText::_('COM_SPPAGEBUILDER_GLOBAL_BOTTOM'),
							'top' => JText::_('COM_SPPAGEBUILDER_GLOBAL_TOP'),
					),
					'std' => 'sppb-text-center',
				),

				'button_title'=>array(
					'type'=>'text',
					'title'=>JText::_('Button Title'),
					'desc'=>JText::_(''),
					'std'=>''
				),

				'url'=>array(
					'type'=>'text',
					'title'=>JText::_('Link'),
					'desc'=>JText::_(''),
					'std'=>  ''
				),

				'video_url'=>array(
					'type'=>'text',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_VIDEO_URL'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_VIDEO_URL_DESC'),
					'std'=>'',
					'depends'=>array(
						array('mp4_enable', '!=', 1)
					)
				),
				'show_rel_video'=>array(
					'type'=>'checkbox',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_VIDEO_OWN_CHANNEL_REL'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_VIDEO_OWN_CHANNEL_REL_DESC'),
					'std'=> 0,
					'depends'=>array(
						array('mp4_enable', '!=', 1)
					)
				),

				'no_cookie'=>array(
					'type'=>'checkbox',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_VIDEO_NO_COOKIE'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_VIDEO_NO_COOKIE_DESC'),
					'std'=>0,
					'depends'=>array(
						array('mp4_enable', '!=', 1)
					)
				),

				// Mp4 Video
				'mp4_enable'=>array(
					'type'=>'checkbox',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_VIDEO_MP4_ENABLE'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_VIDEO_MP4_ENABLE_DESC'),
					'std'=> 0,
				),

				'mp4_video'=>array(
					'type'=>'media',
					'format'=>'video',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_VIDEO_MP4'),
					'depends'=>array(
						array('mp4_enable', '!=', 0)
					),
					'std'=>'https://www.joomshaper.com/media/videos/2017/11/10/pb-intro-video.mp4'
				),
	
				'ogv_video'=>array(
					'type'=>'media',
					'format'=>'video',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_VIDEO_OGV'),
					'depends'=>array(
						array('mp4_enable', '!=', 0)
					)
				),
				
				'video_poster'=>array(
					'type'=>'media',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_VIDEO_POSTER'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_VIDEO_POSTER_DESC'),
					'show_input' => true,
					'std'=>'https://www.joomshaper.com/images/2017/11/10/real-time-frontend.jpg',
					'depends'=>array(
						array('mp4_enable', '!=', 0)
					)
				),

				'show_control'=> array(
					'type'=> 'checkbox',
					'title'=> JText::_('COM_SPPAGEBUILDER_ADDON_VIDEO_CONTROL'),
					'desc'=> JText::_('COM_SPPAGEBUILDER_ADDON_VIDEO_CONTROL_DESC'),
					'std'=> 1,
					'depends'=>array(
						array('mp4_enable', '!=', 0)
					),
				),
				'video_loop'=> array(
					'type'=> 'checkbox',
					'title'=> JText::_('COM_SPPAGEBUILDER_ROW_VIDEO_LOOP'),
					'desc'=> JText::_('COM_SPPAGEBUILDER_ROW_VIDEO_LOOP_DESC'),
					'std'=> 0,
					'depends'=>array(
						array('mp4_enable', '!=', 0)
					),
				),
				'video_mute'=> array(
					'type'=> 'checkbox',
					'title'=> JText::_('COM_SPPAGEBUILDER_ADDON_VIDEO_MUTE'),
					'desc'=> JText::_('COM_SPPAGEBUILDER_ADDON_VIDEO_MUTE_DESC'),
					'std'=> 1,
					'depends'=>array(
						array('mp4_enable', '!=', 0)
					),
				),
				'autoplay_video'=> array(
					'type'=> 'checkbox',
					'title'=> JText::_('COM_SPPAGEBUILDER_ADDON_VIDEO_AUTOPLAY'),
					'desc'=> JText::_('COM_SPPAGEBUILDER_ADDON_VIDEO_AUTOPLAY_DESC'),
					'std'=> 0,
					'depends'=>array(
						array('mp4_enable', '!=', 0)
					),
				),

				'class'=>array(
					'type'=>'text',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_CLASS'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_CLASS_DESC'),
					'std'=>''
				),

			),
		),
	)
);
