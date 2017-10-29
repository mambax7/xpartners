<?php
/**
 * Partner Block
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

define('_XOOPSPARTNERS_DIRNAME', basename(dirname(__DIR__)));

function b_xPartners_show($options)
{
    global $xoTheme;
    $block = [];

    // Get module handler
    $partnersHandler = xoops_getModuleHandler('partners', _XOOPSPARTNERS_DIRNAME);
    // Add stylesheet and scripts
    $xoTheme->addStylesheet(XOOPS_URL . '/modules/' . _XOOPSPARTNERS_DIRNAME . '/assets/css/class.css', null);
    $xoTheme->addScript(XOOPS_URL . '/modules/' . _XOOPSPARTNERS_DIRNAME . '/assets/js/functions.js', null, '');
    $xoTheme->addScript(XOOPS_URL . '/modules/' . _XOOPSPARTNERS_DIRNAME . '/assets/js/mootools-core-1.4.5-full-compat-yc.js', null);
    $xoTheme->addScript(XOOPS_URL . '/modules/' . _XOOPSPARTNERS_DIRNAME . '/assets/js/mooticker.js', null);
    // Get partner list

    //$partners = $partnersHandler->getActive($options[1]);
    $partners = isset($options[1]) ? $partnersHandler->getActive($options[1]) : $partnersHandler->getActive($options[0]);

    if ($partners['count'] > 0) {
        foreach ($partners['list'] as $partner) {
            $block[] = $partner->toArray();
        }
    }

    // Return infos
    return $block;
}

function b_xPartners_edit($options)
{
    // Get module handler
    $categoryHandler = xoops_getModuleHandler('category', _XOOPSPARTNERS_DIRNAME);
    // Construct option
    $form    = _XO_MB_XPARTNERS_CATEGORY . '<select name="' . $options[1] . '">';
    $objects = $categoryHandler->getObj();
    if ($objects['count'] > 0) {
        foreach ($objects['list'] as $object) {
            $category         = [];
            $category['id']   = $object->getVar('cat_id');
            $category['name'] = $object->getVar('cat_title');
            $category['desc'] = $object->getVar('cat_description');
            $form             .= '<option value="' . $category['id'] . '">' . $category['name'] . '</option>';
            unset($category);
        }
    }
    $form .= '</select>';

    // Return form
    return $form;
}
