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
		'addon_name'=>'sp_work',
		'title'=>JText::_('DW Work'),
		'desc'=>JText::_('Work Addon'),
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
					'std' => 'Project Title',
				),

				'desc' => array(
					'type' => 'text',
					'title' => JText::_('Description'),
					'std' => '',
				),

				'bg'=>array(
					'type' => 'media',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_FEATURE_BOX_IMAGE'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_FEATURE_BOX_IMAGE_DESC'),
					'std' => '',
				),

				'button_url'=>array(
					'type'=>'media',
					'format'=>'attachment',
					'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_BUTTON_URL'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_BUTTON_URL_DESC'),
					'placeholder'=>'http://',
					'hide_preview'=>true,
				),

				'size' => array(
					'type' => 'slider',
					'title' => JText::_('Size'),
					'desc' => JText::_('Grid Size'),
					'min' => 1,
					'max' => 2,
					'std' => 1
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
