<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_content
 *
 * @copyright   Copyright (C) 2005 - 2017 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;



//check integration
// $id = JRequest::getVar('id');
// $db = JFactory::getDbo();
// $query = $db->getQuery(true);
// $query->select($db->quoteName(array('text')));
// $query->from($db->quoteName('#__sppagebuilder'));
// $query->where($db->quoteName('extension') . ' = '. $db->quote('com_content'));
// $query->where($db->quoteName('extension_view') . ' = '. $db->quote('article'));
// $query->where($db->quoteName('view_id') . ' = '. $db->quote($id));
// $query->where($db->quoteName('active') . ' = 1');
// $db->setQuery($query);
// $result = $db->loadObject();

// $isIntegration = false;
// $this->item->isBlog = false;
// //blog ids 16/17

// if($this->item->catid == '16' || $this->item->catid == '17' || $this->item->parent_id == '16' || $this->item->parent_id == '17')
// 	$this->item->isBlog = true;


// if(count($result)) {
// 	echo $this->loadTemplate('integration');
// } else {
// 	echo $this->loadTemplate('article');
// }
echo $this->loadTemplate('article');
