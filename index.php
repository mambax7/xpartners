<?php
/**
 * Main page for the xPartners Module
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

// Include header
require_once __DIR__ . '/header.php';

// Get class handler
$categoryHandler = xoops_getModuleHandler('category');
$partnersHandler = xoops_getModuleHandler('partners');

$cat_id = xPartners_CleanVars($_REQUEST, 'cat_id', 0, 'int');
if ($cat_id < 1) {
    // Define template file
    $GLOBALS['xoopsOption']['template_main'] = 'xpartners_index.tpl';
    // Include Xoops header
    include XOOPS_ROOT_PATH . '/header.php';
    // Add module stylesheet and scripts
    $xoTheme->addStylesheet(XOOPS_URL . '/modules/' . $xoopsModule->getVar('dirname', 'n') . '/assets/css/class.css', null);
    $xoTheme->addStylesheet(XOOPS_URL . '/modules/' . $xoopsModule->getVar('dirname', 'n') . '/assets/css/module.css', null);
    $xoTheme->addScript(XOOPS_URL . '/modules/' . $xoopsModule->getVar('dirname', 'n') . '/assets/js/functions.js', null, '');

    $xoopsTpl->assign('module_name', $xoopsModule->getVar('name', 's'));

    $objects = $categoryHandler->getObj();

    if ($objects['count'] > 0) {
        foreach ($objects['list'] as $object) {
            $category         = [];
            $category['id']   = $object->getVar('cat_id');
            $category['name'] = $object->getVar('cat_title');
            $category['desc'] = $object->getVar('cat_description');

            $contentsObj = $partnersHandler->getActive($object->getVar('cat_id'));

            if ($contentsObj['count']) {
                foreach ($contentsObj['list'] as $content) {
                    $category['partners'][] = $content->toArray();
                }
            }
            $xoopsTpl->append_by_ref('categories', $category);
            unset($category);
        }
    }
} else {
    // Define template file
    $GLOBALS['xoopsOption']['template_main'] = 'xpartners_category.tpl';
    // Include Xoops header
    include XOOPS_ROOT_PATH . '/header.php';
    // Add module stylesheet and scripts
    $xoTheme->addStylesheet(XOOPS_URL . '/modules/' . $xoopsModule->getVar('dirname', 'n') . '/assets/css/class.css', null);
    $xoTheme->addStylesheet(XOOPS_URL . '/modules/' . $xoopsModule->getVar('dirname', 'n') . '/assets/css/module.css', null);
    $xoTheme->addScript(XOOPS_URL . '/modules/' . $xoopsModule->getVar('dirname', 'n') . '/assets/js/functions.js', null, '');
    // Template variables
    $xoopsTpl->assign('module_name', $xoopsModule->getVar('name', 's'));
    $cat = $categoryHandler->get($cat_id);
    $xoopsTpl->assign('category', $cat->toArray());
    $partners = $partnersHandler->getActive($cat_id);
    if ($partners['count'] > 0) {
        foreach ($partners['list'] as $partner) {
            $xoopsTpl->append_by_ref('list', $partner->toArray());
        }
    }
}
// Include Xoops footer
require_once XOOPS_ROOT_PATH . '/footer.php';
