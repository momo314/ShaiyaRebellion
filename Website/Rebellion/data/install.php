<?php

define('_JEXEC', 1);
define('DS', DIRECTORY_SEPARATOR);

define('JPATH_BASE', dirname(dirname(dirname(dirname(__FILE__)))) . DS . 'administrator');

require_once dirname(dirname(__FILE__)) . DS . 'library' . DS . 'Artx.php';

require_once JPATH_BASE . DS . 'includes' . DS . 'defines.php';
require_once JPATH_BASE . DS . 'includes' . DS . 'framework.php';
require_once JPATH_BASE . DS . 'includes' . DS . 'helper.php';
require_once JPATH_BASE . DS . 'includes' . DS . 'toolbar.php';

$app = JFactory::getApplication('administrator');
$app->initialise(array('language' => $app->getUserState('application.lang', 'lang')));

// checking user privileges
$user = JFactory::getUser();   
$groups = $user->get("groups");
if (!(isset($groups["Super Users"]) || isset($groups[8])) && !(isset($groups["Administrator"]) || isset($groups[7])))
    exit('error:2:Installing content requires administrator privileges.');

Artx::load('Artx_Data_Loader');

$loader = new Artx_Data_Loader();
$loader->load('data.xml');
echo $loader->execute($_GET);
