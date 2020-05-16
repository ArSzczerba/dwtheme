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
		'addon_name'=>'staticbanner',
		'category'=>'DW',
		'title'=>JText::_('DW Static Banner'),
		'desc'=>JText::_('Static Banner with Doutones Overlay'),
		'attr'=>array(
            'general' => array(
    			'admin_label'=>array(
    				'type'=>'text',
    				'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_ADMIN_LABEL'),
    				'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_ADMIN_LABEL_DESC'),
    				'std'=> ''
    			),

                'title'=>array(
                    'type'=>'text',
                    'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_TITLE'),
                    'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_TITLE_DESC'),
                    'std'=>  ''
                ),

                'subtitle'=>array(
                    'type'=>'text',
                    'title'=>JText::_('Subtitle'),
                    'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_TITLE_DESC'),
                    'std'=>  ''
                ),

				'image'=>array(
					'type'=>'media',
					'title'=>JText::_('Background Image'),
					'desc'=>JText::_(''),
				),

				'gradient'=>array(
					'type'=>'gradient',
					'title'=>JText::_('Gradient'),
					'desc'=>JText::_(''),
				),

                'class'=>array(
    				'type'=>'text',
    				'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_CLASS'),
    				'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_CLASS_DESC'),
    				'std'=> ''
    			),

			)
		)
    )
);
