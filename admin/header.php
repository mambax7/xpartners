<?php
/**
 * Admin header for the xPartners Module
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
include __DIR__ . '/../../../include/cp_header.php';
// Xoops Class
xoops_load('xoopsformloader');
//xoops_load('template');
require_once XOOPS_ROOT_PATH . '/class/template.php';

xoops_loadLanguage('modinfo', $xoopsModule->getVar('dirname'));
// Includes
require_once XOOPS_ROOT_PATH . '/modules/' . $xoopsModule->getVar('dirname') . '/include/functions.php';
// Get menu tab handler
$menuHandler = xoops_getModuleHandler('menu');
// Define top navigation
$menuHandler->addMenuTop(XOOPS_URL . '/modules/system/admin.php?fct=preferences&amp;op=showmod&amp;mod=' . $xoopsModule->getVar('mid'), _PREFERENCES);
$menuHandler->addMenuTop(XOOPS_URL . '/modules/system/admin.php?fct=modulesadmin&amp;op=update&amp;module=' . $xoopsModule->getVar('dirname'), _XO_MI_MENU_MODULEUPDATE);
$menuHandler->addMenuTop(XOOPS_URL . '/modules/' . $xoopsModule->getVar('dirname') . '/', _XO_MI_MENU_MODULEHOME);
// Define main tab navigation
foreach ($xoopsModule->getAdminMenu() as $menu) {
    $menuHandler->addMenuTabs($menu['link'], $menu['title']);
}
