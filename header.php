<?php
/**
 * Header for the xPartners Module
 *
 * LICENSE
 *
 * You may not change or alter any portion of this comment or credits
 * of supporting developers from this source code or any supporting source code
 * which is considered copyrighted (c) material of the original comment or credit authors.
 *
 * @copyright   {@link https://xoops.org/ XOOPS Project}
 * @license     {@link http://www.fsf.org/copyleft/gpl.html GNU public license}
 * @author      Andricq Nicolas (AKA MusS)
 * @since       2.3.0
 */

$path = dirname(dirname(__DIR__));
require_once $path . '/mainfile.php';
require_once $path . '/header.php';
//require_once $path . '/include/cp_functions.php';
//require_once $path . '/include/cp_header.php';

//include dirname(dirname(__DIR__)) . DIRECTORY_SEPARATOR . 'mainfile.php';

require_once XOOPS_ROOT_PATH . '/modules/' . $GLOBALS['xoopsModule']->getVar('dirname') . '/include/functions.php';
// Xoops Class
xoops_load('xoopsformloader');
//xoops_load('template');
// Load template class
require_once XOOPS_ROOT_PATH . '/class/template.php';

// Admin language
xoops_loadLanguage('admin', $xoopsModule->getVar('dirname'));
