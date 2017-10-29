<?php
/**
 * Xpartners module
 *
 * You may not change or alter any portion of this comment or credits
 * of supporting developers from this source code or any supporting source code
 * which is considered copyrighted (c) material of the original comment or credit authors.
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 *
 * @copyright ::  XOOPS Project (https://xoops.org)
 * @license   ::    http://www.fsf.org/copyleft/gpl.html GNU public license
 * @package   ::    Xpartners
 * @subpackage:: admin
 * @since     ::      1.11
 * @author    ::     XOOPS Team
 **/

include __DIR__ . '/../../../include/cp_header.php';
//$path = dirname(dirname(dirname(__DIR__)));
//require_once $path . '/mainfile.php';
//require_once $path . '/include/cp_functions.php';

// Xoops Class
xoops_load('xoopsformloader');
//xoops_load('template');
require_once XOOPS_ROOT_PATH . '/class/template.php';

//require_once __DIR__ . '/../class/utility.php';
//require_once __DIR__ . '/../include/common.php';
require_once __DIR__ . '/../include/functions.php';

$moduleDirName = basename(dirname(__DIR__));

if (false !== ($moduleHelper = Xmf\Module\Helper::getHelper($moduleDirName))) {
} else {
    $moduleHelper = Xmf\Module\Helper::getHelper('system');
}
$adminObject = \Xmf\Module\Admin::getInstance();

$pathIcon16    = \Xmf\Module\Admin::iconUrl('', 16);
$pathIcon32    = \Xmf\Module\Admin::iconUrl('', 32);
$pathModIcon32 = $moduleHelper->getModule()->getInfo('modicons32');

// Load language files
$moduleHelper->loadLanguage('admin');
$moduleHelper->loadLanguage('modinfo');
$moduleHelper->loadLanguage('main');

$myts = MyTextSanitizer::getInstance();

if (!isset($GLOBALS['xoopsTpl']) || !($GLOBALS['xoopsTpl'] instanceof XoopsTpl)) {
    require_once $GLOBALS['xoops']->path('class/template.php');
    $xoopsTpl = new XoopsTpl();
}

// Get module handler
$partnersHandler = xoops_getModuleHandler('partners');
$categoryHandler = xoops_getModuleHandler('category');
