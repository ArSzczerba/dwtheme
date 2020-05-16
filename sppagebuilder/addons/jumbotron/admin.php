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
		'addon_name'=>'sp_jumbotron',
		'title'=>JText::_('Jumbotron'),
		'desc'=>JText::_(''),
		'category'=>'DW',
		'attr'=>array(
			'general' => array(
				'admin_label'=>array(
					'type'=>'text',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_ADMIN_LABEL'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_ADMIN_LABEL_DESC'),
					'std'=> ''
				),
				
				'subtitle' => array(
					'type' => 'text',
					'title' => JText::_('H2 SubTitle'),
					'std' => 'H2 subtitle',
				),

				'title' => array(
					'type' => 'textarea',
					'title' => JText::_('H1 Title'),
					'std' => 'H1 title',
				),

				'title_text_color'=>array(
					'type'=>'color',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_TITLE_TEXT_COLOR'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_TITLE_TEXT_COLOR_DESC'),
					'depends'=>array(array('title', '!=', '')),
				),


				'image_desktop'=>array(
					'type' => 'media',
					'title'=>JText::_('Desktop Image'),
					'desc'=>JText::_(''),
					'std' => '',
				),

				'mask_desktop'=>array(
					'type' => 'media',
					'title'=>JText::_('Desktop Mask'),
					'desc'=>JText::_(''),
					'std' => '',
				),

				'image_mobile'=>array(
					'type' => 'media',
					'title'=>JText::_('Mobile Image'),
					'desc'=>JText::_(''),
					'std' => '',
				),
				'alignment' => array(
					'type' => 'select',
					'title' => JText::_('COM_SPPAGEBUILDER_ADDON_GLOBAL_CONTENT_ALIGNMENT'),
					'desc' => JText::_('COM_SPPAGEBUILDER_ADDON_GLOBAL_CONTENT_ALIGNMENT_DESC'),
					'values' => array(
							'sppb-text-left' => JText::_('COM_SPPAGEBUILDER_GLOBAL_LEFT'),
							'sppb-text-center' => JText::_('COM_SPPAGEBUILDER_GLOBAL_CENTER'),
							'sppb-text-right' => JText::_('COM_SPPAGEBUILDER_GLOBAL_RIGHT'),
					),
					'std' => 'sppb-text-center',
				),
				'class'=>array(
					'type'=>'text',
					'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_CLASS'),
					'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_CLASS_DESC'),
					'std'=>''
				),

				

				'sp_button_group_item' => array(
					'title' => JText::_('COM_SPPAGEBUILDER_ADDON_BUTTONS_ITEM'),
						'attr' => array(
							'title' => array(
								'type' => 'text',
								'title' => JText::_('COM_SPPAGEBUILDER_GLOBAL_BUTTON_TEXT'),
								'desc' => JText::_('COM_SPPAGEBUILDER_GLOBAL_BUTTON_TEXT_DESC'),
								'std' => 'Button',
							),

							'font_family' => array(
								'type' => 'fonts',
								'title' => JText::_('COM_SPPAGEBUILDER_ADDON_GLOBAL_FONT_FAMILY'),
								'selector' => array(
									'type' => 'font',
									'font' => '{{ VALUE }}',
									'css' => '.sppb-btn { font-family: "{{ VALUE }}"; }'
								)
							),

							'font_style' => array(
								'type' => 'fontstyle',
								'title' => JText::_('COM_SPPAGEBUILDER_GLOBAL_BUTTON_FONT_STYLE'),
								'std' => ''
							),

							'letterspace' => array(
								'type' => 'select',
								'title' => JText::_('COM_SPPAGEBUILDER_GLOBAL_BUTTON_LETTER_SPACING'),
								'values' => array(
									'0' => 'Default',
									'1px' => '1px',
									'2px' => '2px',
									'3px' => '3px',
									'4px' => '4px',
									'5px' => '5px',
									'6px' => '6px',
									'7px' => '7px',
									'8px' => '8px',
									'9px' => '9px',
									'10px' => '10px'
								),
								'std' => '0'
							),
						
							'url' => array(
								'type' => 'media',
								'format' => 'attachment',
								'hide_preview' => true,
								'title' => JText::_('COM_SPPAGEBUILDER_GLOBAL_BUTTON_URL'),
								'desc' => JText::_('COM_SPPAGEBUILDER_GLOBAL_BUTTON_URL_DESC'),
								'placeholder' => 'http://',
								'hide_preview' => true,
							),

							'type' => array(
								'type' => 'select',
								'title' => JText::_('COM_SPPAGEBUILDER_GLOBAL_BUTTON_STYLE'),
								'desc' => JText::_('COM_SPPAGEBUILDER_GLOBAL_BUTTON_STYLE_DESC'),
								'values' => array(
									'default' => JText::_('COM_SPPAGEBUILDER_GLOBAL_DEFAULT'),
									'primary' => JText::_('COM_SPPAGEBUILDER_GLOBAL_PRIMARY'),
									'secondary' => JText::_('COM_SPPAGEBUILDER_GLOBAL_SECONDARY'),
									'success' => JText::_('COM_SPPAGEBUILDER_GLOBAL_SUCCESS'),
									'info' => JText::_('COM_SPPAGEBUILDER_GLOBAL_INFO'),
									'warning' => JText::_('COM_SPPAGEBUILDER_GLOBAL_WARNING'),
									'danger' => JText::_('COM_SPPAGEBUILDER_GLOBAL_DANGER'),
									'dark' => JText::_('COM_SPPAGEBUILDER_GLOBAL_DARK'),
									'link' => JText::_('COM_SPPAGEBUILDER_GLOBAL_LINK'),
									'custom' => JText::_('COM_SPPAGEBUILDER_GLOBAL_CUSTOM'),
									'cta' => JText::_('CTA'),
								),
								'std' => 'primary',
							),

							'ctacolor' => array(
								'type' => 'select',
								'title' => JText::_('CTA Color'),
								'desc' => JText::_(''),
								'values' => array(
									'default' => JText::_('Default'),
									'white' => JText::_('White'),
								),
								'std' => '',
								'depends' => array(
									array('type', '==', 'cta'),
								)
							),

							'appearance' => array(
								'type' => 'select',
								'title' => JText::_('COM_SPPAGEBUILDER_GLOBAL_BUTTON_APPEARANCE'),
								'desc' => JText::_('COM_SPPAGEBUILDER_GLOBAL_BUTTON_APPEARANCE_DESC'),
								'values' => array(
									'' => JText::_('COM_SPPAGEBUILDER_GLOBAL_BUTTON_APPEARANCE_FLAT'),
									'outline' => JText::_('COM_SPPAGEBUILDER_GLOBAL_BUTTON_APPEARANCE_OUTLINE'),
									'3d' => JText::_('COM_SPPAGEBUILDER_GLOBAL_BUTTON_APPEARANCE_3D'),
									'gradient' => JText::_('COM_SPPAGEBUILDER_GLOBAL_BUTTON_APPEARANCE_GRADIENT'),
								),
								'std' => 'flat',
								'depends' => array(
									array('type', '!=', 'link'),
								)
							),

							'fontsize' => array(
									'type' => 'slider',
									'title' => JText::_('COM_SPPAGEBUILDER_GLOBAL_FONT_SIZE'),
									'std' => array('md' => 16),
									'responsive' => true,
									'max' => 400,
									'depends' => array(
											array('type', '=', 'custom'),
									)
							),
							'button_status' => array(
									'type' => 'buttons',
									'title' => JText::_('COM_SPPAGEBUILDER_GLOBAL_ENABLE_BACKGROUND_OPTIONS'),
									'std' => 'normal',
									'values' => array(
											array(
													'label' => 'Normal',
													'value' => 'normal'
											),
											array(
													'label' => 'Hover',
													'value' => 'hover'
											),
									),
									'tabs' => true,
									'depends' => array(
											array('type', '=', 'custom'),
									)
							),
							'background_color' => array(
									'type' => 'color',
									'title' => JText::_('COM_SPPAGEBUILDER_GLOBAL_BUTTON_BACKGROUND_COLOR'),
									'desc' => JText::_('COM_SPPAGEBUILDER_GLOBAL_BUTTON_BACKGROUND_COLOR_DESC'),
									'std' => '#444444',
									'depends' => array(
											array('appearance', '!=', 'gradient'),
											array('type', '=', 'custom'),
											array('button_status', '=', 'normal'),
									)
							),
							'background_gradient' => array(
									'type' => 'gradient',
									'title' => JText::_('COM_SPPAGEBUILDER_GLOBAL_BACKGROUND_GRADIENT'),
									'std' => array(
											"color" => "#B4EC51",
											"color2" => "#429321",
											"deg" => "45",
											"type" => "linear"
									),
									'depends' => array(
											array('appearance', '=', 'gradient'),
											array('type', '=', 'custom'),
											array('button_status', '=', 'normal'),
									)
							),
							'color' => array(
									'type' => 'color',
									'title' => JText::_('COM_SPPAGEBUILDER_GLOBAL_BUTTON_COLOR'),
									'desc' => JText::_('COM_SPPAGEBUILDER_GLOBAL_BUTTON_COLOR_DESC'),
									'std' => '#fff',
									'depends' => array(
											array('type', '=', 'custom'),
											array('button_status', '=', 'normal'),
									),
							),
							'background_color_hover' => array(
									'type' => 'color',
									'title' => JText::_('COM_SPPAGEBUILDER_GLOBAL_BUTTON_BACKGROUND_COLOR_HOVER'),
									'desc' => JText::_('COM_SPPAGEBUILDER_GLOBAL_BUTTON_BACKGROUND_COLOR_HOVER_DESC'),
									'std' => '#222',
									'depends' => array(
											array('appearance', '!=', 'gradient'),
											array('type', '=', 'custom'),
											array('button_status', '=', 'hover'),
									)
							),
							'background_gradient_hover' => array(
									'type' => 'gradient',
									'title' => JText::_('COM_SPPAGEBUILDER_GLOBAL_BACKGROUND_GRADIENT'),
									'std' => array(
											"color" => "#429321",
											"color2" => "#B4EC51",
											"deg" => "45",
											"type" => "linear"
									),
									'depends' => array(
											array('appearance', '=', 'gradient'),
											array('type', '=', 'custom'),
											array('button_status', '=', 'hover'),
									)
							),
							'color_hover' => array(
									'type' => 'color',
									'title' => JText::_('COM_SPPAGEBUILDER_GLOBAL_BUTTON_COLOR_HOVER'),
									'desc' => JText::_('COM_SPPAGEBUILDER_GLOBAL_BUTTON_COLOR_HOVER_DESC'),
									'std' => '#fff',
									'depends' => array(
											array('type', '=', 'custom'),
											array('button_status', '=', 'hover'),
									),
							),

							//Link Button Style
							'link_button_status' => array(
								'type' => 'buttons',
								'title' => JText::_('COM_SPPAGEBUILDER_GLOBAL_BUTTON_STYLE'),
								'std' => 'normal',
								'values' => array(
									array(
										'label' => 'Normal',
										'value' => 'normal'
									),
									array(
										'label' => 'Hover',
										'value' => 'hover'
									),
								),
								'tabs' => true,
								'depends' => array(
									array('type', '=', 'link'),
								)
							),
							'link_button_color' => array(
								'type' => 'color',
								'title' => JText::_('COM_SPPAGEBUILDER_GLOBAL_COLOR'),
								'std' => '',
								'depends' => array(
									array('type', '=', 'link'),
									array('link_button_status', '=', 'normal'),
								)
							),
							'link_button_border_width' => array(
								'type' => 'slider',
								'title' => JText::_('COM_SPPAGEBUILDER_GLOBAL_BORDER_WIDTH'),
								'max'=> 30,
								'std' => '',
								'depends' => array(
									array('type', '=', 'link'),
									array('link_button_status', '=', 'normal'),
								)
							),
							'link_border_color' => array(
								'type' => 'color',
								'title' => JText::_('COM_SPPAGEBUILDER_GLOBAL_BORDER_COLOR'),
								'std' => '',
								'depends' => array(
									array('type', '=', 'link'),
									array('link_button_status', '=', 'normal'),
								)
							),

							'link_button_padding_bottom' => array(
								'type' => 'slider',
								'title' => JText::_('COM_SPPAGEBUILDER_GLOBAL_BUTTON_PADDING_BOTTOM'),
								'max'=>100,
								'std' => '',
								'depends' => array(
									array('type', '=', 'link'),
									array('link_button_status', '=', 'normal'),
								)
							),

							//Link Hover
							'link_button_hover_color' => array(
								'type' => 'color',
								'title' => JText::_('COM_SPPAGEBUILDER_GLOBAL_COLOR_HOVER'),
								'std' => '',
								'depends' => array(
									array('type', '=', 'link'),
									array('link_button_status', '=', 'hover'),
								)
							),

							'link_button_border_hover_color' => array(
								'type' => 'color',
								'title' => JText::_('COM_SPPAGEBUILDER_GLOBAL_BORDER_COLOR_HOVER'),
								'std' => '',
								'depends' => array(
									array('type', '=', 'link'),
									array('link_button_status', '=', 'hover'),
								)
							),

							'size' => array(
								'type' => 'select',
								'title' => JText::_('COM_SPPAGEBUILDER_GLOBAL_BUTTON_SIZE'),
								'desc' => JText::_('COM_SPPAGEBUILDER_GLOBAL_BUTTON_SIZE_DESC'),
								'values' => array(
									'' => JText::_('COM_SPPAGEBUILDER_GLOBAL_BUTTON_SIZE_DEFAULT'),
									'lg' => JText::_('COM_SPPAGEBUILDER_GLOBAL_BUTTON_SIZE_LARGE'),
									'xlg' => JText::_('COM_SPPAGEBUILDER_GLOBAL_BUTTON_SIZE_XLARGE'),
									'sm' => JText::_('COM_SPPAGEBUILDER_GLOBAL_BUTTON_SIZE_SMALL'),
									'xs' => JText::_('COM_SPPAGEBUILDER_GLOBAL_BUTTON_SIZE_EXTRA_SAMLL'),
								),
							),

							'button_padding' => array(
								'type' => 'padding',
								'title' => JText::_('COM_SPPAGEBUILDER_GLOBAL_PADDING'),
								'desc' => JText::_('COM_SPPAGEBUILDER_GLOBAL_PADDING_DESC'),
								'std' => '',
								'depends' => array(
									array('type', '=', 'custom'),
								),
								'responsive' => true
							),

							'shape' => array(
								'type' => 'select',
								'title' => JText::_('COM_SPPAGEBUILDER_GLOBAL_BUTTON_SHAPE'),
								'desc' => JText::_('COM_SPPAGEBUILDER_GLOBAL_BUTTON_SHAPE_DESC'),
								'values' => array(
									'rounded' => JText::_('COM_SPPAGEBUILDER_GLOBAL_BUTTON_SHAPE_ROUNDED'),
									'square' => JText::_('COM_SPPAGEBUILDER_GLOBAL_BUTTON_SHAPE_SQUARE'),
									'round' => JText::_('COM_SPPAGEBUILDER_GLOBAL_BUTTON_SHAPE_ROUND'),
								),
							),

							'block' => array(
								'type' => 'select',
								'title' => JText::_('COM_SPPAGEBUILDER_GLOBAL_BUTTON_BLOCK'),
								'desc' => JText::_('COM_SPPAGEBUILDER_GLOBAL_BUTTON_BLOCK_DESC'),
								'values' => array(
									'' => JText::_('JNO'),
									'sppb-btn-block' => JText::_('JYES'),
								),
							),

							'icon' => array(
								'type' => 'icon',
								'title' => JText::_('COM_SPPAGEBUILDER_GLOBAL_BUTTON_ICON'),
								'desc' => JText::_('COM_SPPAGEBUILDER_GLOBAL_BUTTON_ICON_DESC'),
							),

							'icon_position' => array(
								'type' => 'select',
								'title' => JText::_('COM_SPPAGEBUILDER_GLOBAL_BUTTON_ICON_POSITION'),
								'values' => array(
									'left' => JText::_('COM_SPPAGEBUILDER_GLOBAL_LEFT'),
									'right' => JText::_('COM_SPPAGEBUILDER_GLOBAL_RIGHT'),
								),
							),

							'target' => array(
								'type' => 'select',
								'title' => JText::_('COM_SPPAGEBUILDER_GLOBAL_LINK_NEWTAB'),
								'desc' => JText::_('COM_SPPAGEBUILDER_GLOBAL_LINK_NEWTAB_DESC'),
								'values' => array(
									'' => JText::_('COM_SPPAGEBUILDER_ADDON_GLOBAL_TARGET_SAME_WINDOW'),
									'_blank' => JText::_('COM_SPPAGEBUILDER_ADDON_GLOBAL_TARGET_NEW_WINDOW'),
								),
							),
						),
					),
			),
		),
	)
);
