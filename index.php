<?php
/**
 * @package     Joomla.Site
 * @subpackage  Templates.protostar
 *
 * @copyright   Copyright (C) 2005 - 2019 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

/** @var JDocumentHtml $this */

$app  = JFactory::getApplication();
$user = JFactory::getUser();

// Output as HTML5
$this->setHtml5(true);

// Getting params from template
$params = $app->getTemplate(true)->params;

// Detecting Active Variables
$option   = $app->input->getCmd('option', '');
$view     = $app->input->getCmd('view', '');
$layout   = $app->input->getCmd('layout', '');
$task     = $app->input->getCmd('task', '');
$itemid   = $app->input->getCmd('Itemid', '');
$sitename = htmlspecialchars($app->get('sitename'), ENT_QUOTES, 'UTF-8');

$articleId = null;
$isBlogPost = false;
if($option == 'com_content' && 'layout' == 'article'){
	$articleId = $app->input->getCmd('id', '');
	$article = JControllerLegacy::getInstance('Content')->getModel('Article')->getItem($articleId);
	if($article->category_title == "Blog" || $article->parent_title == "Blog"){
		$isBlog = true;
	
	}
}
if ($task === 'edit' || $layout === 'form') {
	$fullWidth = 1;
} else {
	$fullWidth = 0;
}

// page class
$menu = $app->getMenu()->getActive();
$pageclass = '';

if (is_object($menu))
	$pageclass = $menu->params->get('pageclass_sfx');


// Add JavaScript Frameworks
JHtml::_('script', 'popper.min.js', array('version' => 'auto', 'relative' => true));
JHtml::_('bootstrap.framework');

// Add template js
JHtml::_('script', 'template.js', array('version' => 'auto', 'relative' => true));

// Add html5 shiv
JHtml::_('script', 'jui/html5.js', array('version' => 'auto', 'relative' => true, 'conditional' => 'lt IE 9'));

// Add Bootstrap CSS
JHtml::_('stylesheet', 'bootstrap.min.css', array('version' => 'auto', 'relative' => true));

// Add Stylesheets
JHtml::_('stylesheet', 'template.css', array('version' => 'auto', 'relative' => true));

JHtml::_('script', 'components/com_sppagebuilder/assets/js/sppagebuilder.js', array('version' => 'auto', 'relative' => false));
JHtml::_('stylesheet', 'components/com_sppagebuilder/assets/css/font-awesome.min.css', array('version' => 'auto', 'relative' => false));
JHtml::_('stylesheet', 'components/com_sppagebuilder/assets/css/animate.min.css', array('version' => 'auto', 'relative' => false));
JHtml::_('stylesheet', 'components/com_sppagebuilder/assets/css/sppagecontainer.css', array('version' => 'auto', 'relative' => false));
JHtml::_('stylesheet', 'components/com_sppagebuilder/assets/css/sppagebuilder.css', array('version' => 'auto', 'relative' => false));
JHtml::_('stylesheet', '//use.typekit.net/iyu2aoc.css', array('version' => 'auto', 'relative' => false, 'rel' => 'preload'));

JHtml::_('stylesheet', 'swiper.min.css', array('version' => '4.5.0', 'relative' => true));
JHtml::_('script', 'swiper.min.js', array('version' => '4.5.0', 'relative' => true));

// Load optional RTL Bootstrap CSS
JHtml::_('bootstrap.loadCss', false, $this->direction);

$isIntegration = false;
if($view == 'article'){
	//check integration
	$id = JRequest::getVar('id');
	$db = JFactory::getDbo();
	$query = $db->getQuery(true);
	$query->select($db->quoteName(array('text')));
	$query->from($db->quoteName('#__sppagebuilder'));
	$query->where($db->quoteName('extension') . ' = '. $db->quote('com_content'));
	$query->where($db->quoteName('extension_view') . ' = '. $db->quote('article'));
	$query->where($db->quoteName('view_id') . ' = '. $db->quote($id));
	$query->where($db->quoteName('active') . ' = 1');
	$db->setQuery($query);
	$result = $db->loadObject();
	
	if($result) {
		$isIntegration = true;
	}
}

$isPageBuilder = false;
if($isIntegration) $isPageBuilder = true;
if($option == 'com_sppagebuilder') $isPageBuilder = true; 


// Adjusting content width
$position7ModuleCount = $this->countModules('position-7');
$position8ModuleCount = $this->countModules('position-8');

if ($position7ModuleCount && $position8ModuleCount) {
	$span = 'col-md-6';
} elseif ($position7ModuleCount && !$position8ModuleCount) {
	$span = 'col-md-9';
} elseif (!$position7ModuleCount && $position8ModuleCount) {
	$span = 'col-md-9';
} else {
	$span = 'col-md-12';
}

// Logo file or site title param
if ($this->params->get('logoFile')) {
	$logo = '<img src="' . JUri::root() . $this->params->get('logoFile') . '" alt="' . $sitename . '" />';
} elseif ($this->params->get('sitetitle')) {
	$logo = '<span class="site-title" title="' . $sitename . '">' . htmlspecialchars($this->params->get('sitetitle'), ENT_COMPAT, 'UTF-8') . '</span>';
} else {
	$logo = '<span class="site-title" title="' . $sitename . '">' . $sitename . '</span>';
}
?>
<!DOCTYPE html>
<html lang="<?php echo $this->language; ?>" dir="<?php echo $this->direction; ?>">

<head>
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<script src="<?php echo $this->baseurl . '/templates/' . $this->template . '/js/popper.min.js';?>"></script>
	<jdoc:include type="head" />
	<script type="text/javascript">
		var _gaq = _gaq || [];
		_gaq.push(['_setAccount', 'UA-26307211-1']);
		_gaq.push(['_trackPageview']);

		(function() {
			var ga = document.createElement('script');
			ga.type = 'text/javascript';
			ga.async = true;
			ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
			var s = document.getElementsByTagName('script')[0];
			s.parentNode.insertBefore(ga, s);
		})();
	</script>
</head>

<body class="site offcanvas-init <?php echo $option
																		. ' view-' . $view
																		. ($layout ? ' layout-' . $layout : ' no-layout')
																		. ($task ? ' task-' . $task : ' no-task')
																		. ($itemid ? ' itemid-' . $itemid : '')
																		. ($params->get('fluidContainer') ? ' fluid' : '')
																		. ($isBlog ? ' blog' : '')
																		. ($pageclass ? htmlspecialchars($pageclass) : 'default')
																		. ($this->direction === 'rtl' ? ' rtl' : '');
																	?>">

	<!-- Header -->
	<header class="header py-3" role="banner">
		<div class="header-inner px-5">
			<div class="d-flex align-items-center">
				<div class="dw-menu">
					<button id="offcanvas-toggler" class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
						<span class="navbar-toggler-icon"></span>
						<span class="navbar-toggler-icon"></span>
						<span class="navbar-toggler-icon"></span>
					</button>
				</div>
				<a class="brand" href="<?php echo $this->baseurl; ?>/">
					<img class="load" alt="<?php echo $sitename; ?>" src="<?php echo JUri::root() ?>images/logo/dw_logo_white_MAY2017.svg" />
				</a>
				<div>
					<div class="offcanvas-body">
						<div class="main-menu">
							<div class="sp-module">
								<div class="sp-module-content">
									<jdoc:include type="modules" name="offcanvas" style="none" />
								</div>
							</div>
						</div>
					</div>
				</div>
				<a class="btn btn-quick-contact" href="contact">Get in touch</a>
			</div>
			
		</div>
	</header>

	<!-- Body -->
	<div class="body" id="top">
		<div id="wrapper">
		<?php if (!$isPageBuilder) : ?>
			<div class="container<?php echo ($params->get('fluidContainer') ? '-fluid' : ''); ?>">


				<div class="row">
					<?php if ($position8ModuleCount) : ?>
						<!-- Begin Sidebar -->
						<div id="sidebar" class="col-md-3">
							<div class="sidebar-nav">
								<jdoc:include type="modules" name="position-8" style="xhtml" />
							</div>
						</div>
						<!-- End Sidebar -->
					<?php endif; ?>
					<main id="content" role="main" class="<?php echo $span; ?>">
						<!-- Begin Content -->
						<jdoc:include type="modules" name="position-3" style="xhtml" />
						<jdoc:include type="message" />
						<jdoc:include type="component" />
						<div class="clearfix"></div>
						<jdoc:include type="modules" name="position-2" style="none" />
						<!-- End Content -->
					</main>
					<?php if ($position7ModuleCount) : ?>
						<div id="aside" class="col-md-3">
							<!-- Begin Right Sidebar -->
							<jdoc:include type="modules" name="position-7" style="well" />
							<!-- End Right Sidebar -->
						</div>
					<?php endif; ?>
				</div>
			</div>
		<?php else : ?>
			
			<main id="content" role="main">
				<!-- Begin Content -->
				<jdoc:include type="modules" name="position-3" style="xhtml" />
				<jdoc:include type="message" />
				<jdoc:include type="component" />
				<div class="clearfix"></div>
				<jdoc:include type="modules" name="position-2" style="none" />
				<!-- End Content -->
			</main>
		<?php endif; ?>
		</div>
	</div>
	<!-- Footer -->
	<footer class="footer" role="contentinfo">
		<div class="container text-center">
			<a class="brand" href="<?php echo $this->baseurl; ?>/">
				<img class="load" alt="<?php echo $sitename; ?>" src="<?php echo JUri::root() ?>images/logo/dw_logo_white_MAY2017.svg" />
			</a>
			<p class="h2 text-normal">Join and get news and updates first</p>
			
			<div class="social-media">
				<?php if ($this->params->get('twitter')): ?>
					<a href="<?php echo $this->params->get('twitter'); ?>" target="_blank" rel="noreferrer"> 
					<i class="fa fa-twitter" aria-hidden="true"></i>
					</a>
				<?php endif; ?>
				<?php if ($this->params->get('facebook')): ?>
					<a href="<?php echo $this->params->get('facebook'); ?>" target="_blank" rel="noreferrer"> 
					<i class="fa fa-facebook" aria-hidden="true"></i>
					</a>
				<?php endif; ?>
				<?php if ($this->params->get('instagram')): ?>
					<a href="<?php echo $this->params->get('instagram'); ?>" target="_blank" rel="noreferrer"> 
					<i class="fa fa-instagram" aria-hidden="true"></i>
					</a>
				<?php endif; ?>
				<?php if ($this->params->get('pinterest')): ?>
					<a href="<?php echo $this->params->get('pinterest'); ?>" target="_blank" rel="noreferrer"> 
					<i class="fa fa-pinterest" aria-hidden="true"></i>
					</a>
				<?php endif; ?>
				<?php if ($this->params->get('linkedin')): ?>
					<a href="<?php echo $this->params->get('linkedin'); ?>" target="_blank" rel="noreferrer"> 
					<i class="fa fa-linkedin" aria-hidden="true"></i>
					</a>
				<?php endif; ?>
			</div>	
			<div>
			<jdoc:include type="modules" name="footer" style="xhtml" />
			</div>
			<p>&copy; <?php echo  date('Y'); ?> DW Graphic Design Ltd. Registered in England No. 4974067, VAT Registration No. 738145817</p>

			<jdoc:include type="modules" name="policy" style="xhtml" />

		</div>
	</footer>
	<jdoc:include type="modules" name="debug" style="none" />

</body>

</html>