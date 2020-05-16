<?php

/**
 * @package Qubic
 * @author JoomShaper http://www.joomshaper.com
 * @copyright Copyright (c) 2010 - 2015 JoomShaper
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or later
 */
//no direct accees
defined('_JEXEC') or die('resticted aceess');

SpAddonsConfig::addonConfig(
	array(
		'type' => 'repeatable',
		'addon_name' => 'related',
		'category' => 'DW',
		'title' => JText::_('Related Articles'),
		'desc' => JText::_(''),
		'attr' => array(
			'general' => array(

				'class' => array(
					'type' => 'text',
					'title' => JText::_('COM_SPPAGEBUILDER_ADDON_CLASS'),
					'desc' => JText::_('COM_SPPAGEBUILDER_ADDON_CLASS_DESC'),
					'std' => ''
				),

				'sp_repetable_item' => array(
					'type' => 'repeatable',
					'attr' =>  array(
						'title' => array(
							'type' => 'text',
							'title' => JText::_('Title'),
							'desc' => JText::_(''),
							'std' => 'Item Title',
						),

						'subtitle' => array(
							'type' => 'text',
							'title' => JText::_('Subtitle'),
							'desc' => JText::_(''),
							'std' => '',
						),

						'avatar' => array(
							'type' => 'media',
							'title' => JText::_('Avatar'),
							'desc' => JText::_('images/logo/thumbs/avatar_72x72.png'),
						),

						'image' => array(
							'type' => 'media',
							'title' => JText::_('Article Image'),
							'desc' => JText::_(''),
						),

						'url' => array(
							'type' => 'text',
							'title' => JText::_('Link'),
							'desc' => JText::_(''),
							'std' => '',
						),

						'readmore'=>array(
							'type'=>'select',
							'title'=>JText::_('Read more button'),
							'desc'=>JText::_(''),
							'values'=>array(
								''=>JText::_('Blank'),
								'readmore'=>JText::_('Read More'),
								'viewcase'=>JText::_('View Case Study'),
							),
						),

					)
				),
			),

		)

	)
);
