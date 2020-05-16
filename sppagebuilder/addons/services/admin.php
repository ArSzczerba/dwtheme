<?php
/**
 * @package SP Page Builder
 * @author JoomShaper http://www.joomshaper.com
 * @copyright Copyright (c) 2010 - 2019 JoomShaper
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or later
 */
//no direct accees
defined('_JEXEC') or die('Restricted access');

SpAddonsConfig::addonConfig(
	array(
		'type' => 'repeatable',
		'addon_name' => 'sp_services',
		'title' => JText::_('Services Hover Expand'),
		'desc' => JText::_(''),
		'category' => 'DW',
		'attr' => array(
			'general' => array(

				'admin_label' => array(
					'type' => 'text',
					'title' => JText::_('COM_SPPAGEBUILDER_ADDON_ADMIN_LABEL'),
					'desc' => JText::_('COM_SPPAGEBUILDER_ADDON_ADMIN_LABEL_DESC'),
					'std' => ''
				),

				'class' => array(
					'type' => 'text',
					'title' => JText::_('COM_SPPAGEBUILDER_ADDON_CLASS'),
					'desc' => JText::_('COM_SPPAGEBUILDER_ADDON_CLASS_DESC'),
					'std' => ''
				),

				//repeatable
				'sp_service_item' => array(
					'title' => JText::_('COM_SPPAGEBUILDER_ADDON_CAROUSEL_ITEMS'),
					'attr' =>  array(

						'title' => array(
							'type' => 'text',
							'title' => JText::_('COM_SPPAGEBUILDER_ADDON_CAROUSEL_ITEM_TITLE'),
							'std' => 'Where Art and Technology Collide',
						),

						'content' => array(
							'type' => 'editor',
							'title' => JText::_('COM_SPPAGEBUILDER_ADDON_CAROUSEL_ITEM_CONTENT'),
							'desc' => JText::_('COM_SPPAGEBUILDER_ADDON_CAROUSEL_ITEM_CONTENT_DESC'),
							'std' => 'You might remember the Dell computer commercials in which a youth reports this exciting news to his friends.<br />That they are about to get their new computer.'
						),


						'bg' => array(
							'type' => 'media',
							'title' => JText::_('COM_SPPAGEBUILDER_ADDON_CAROUSEL_ITEM_BACKGROUND_IMAGE'),
							'desc' => JText::_('COM_SPPAGEBUILDER_ADDON_CAROUSEL_ITEM_BACKGROUND_IMAGE_DESC'),
							'format' => 'image',
							'std' => 'https://sppagebuilder.com/addons/carousel/carousel-bg.jpg'
						),

						'background_color' => array(
							'type' => 'color',
							'title' => JText::_('COM_SPPAGEBUILDER_GLOBAL_BUTTON_BACKGROUND_COLOR'),
							'desc' => JText::_('COM_SPPAGEBUILDER_GLOBAL_BUTTON_BACKGROUND_COLOR_DESC'),
							'std' => '#444444',
						),

						'button_text' => array(
							'type' => 'text',
							'title' => JText::_('COM_SPPAGEBUILDER_GLOBAL_BUTTON_TEXT'),
							'desc' => JText::_('COM_SPPAGEBUILDER_GLOBAL_BUTTON_TEXT_DESC'),
							'std' => 'View Service',
						),

						'button_url'=>array(
							'type'=>'media',
							'format'=>'attachment',
							'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_BUTTON_URL'),
							'desc'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_BUTTON_URL_DESC'),
							'placeholder'=>'http://',
							'hide_preview'=>true,
							'depends'=> array(
								array('button_text', '!=', ''),
							)
						),

						'button_target'=>array(
							'type'=>'select',
							'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_LINK_NEWTAB'),
							'desc'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_LINK_NEWTAB_DESC'),
							'values'=>array(
								''=>JText::_('COM_SPPAGEBUILDER_ADDON_GLOBAL_TARGET_SAME_WINDOW'),
								'_blank'=>JText::_('COM_SPPAGEBUILDER_ADDON_GLOBAL_TARGET_NEW_WINDOW'),
							),
							'depends'=> array(
								array('button_text', '!=', ''),
							)
						),
					),
				),
			),
		),
	)
);
