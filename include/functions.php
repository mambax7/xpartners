<?php
/**
 * Module specific Functions for Xoops Parteners
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

/**
 * xoopsFaq_CleanVars()
 *
 * @param        $global
 * @param        $key
 * @param string $default
 * @param string $type
 * @return mixed|string
 */
function xPartners_CleanVars(&$global, $key, $default = '', $type = 'int')
{
    switch ($type) {
        case 'string':
            $ret = isset($global[$key]) ? filter_var($global[$key], FILTER_SANITIZE_MAGIC_QUOTES) : $default;
            break;
        case 'int':
        default:
            $ret = isset($global[$key]) ? filter_var($global[$key], FILTER_SANITIZE_NUMBER_INT) : $default;
            break;
    }
    if (false === $ret) {
        return $default;
    }

    return $ret;
}

/**
 * xoopsParteners_setting
 *
 * @author      Instant Zero (http://xoops.instant-zero.com)
 * @copyright   Instant Zero
 * @param string $option module option's name
 *
 * @param string $repmodule
 * @return bool
 */
function xPartners_setting($option, $repmodule = 'xpartners')
{
    global $xoopsModuleConfig, $xoopsModule;
    static $tbloptions = [];
    if (is_array($tbloptions) && array_key_exists($option, $tbloptions)) {
        return $tbloptions[$option];
    }

    $retval = false;
    if (isset($xoopsModuleConfig) && (is_object($xoopsModule) && $xoopsModule->getVar('dirname') == $repmodule && $xoopsModule->getVar('isactive'))) {
        if (isset($xoopsModuleConfig[$option])) {
            $retval = $xoopsModuleConfig[$option];
        }
    } else {
        $moduleHandler = xoops_getHandler('module');
        $module        = $moduleHandler->getByDirname($repmodule);
        $configHandler = xoops_getHandler('config');
        if ($module) {
            $moduleConfig = $configHandler->getConfigsByCat(0, $module->getVar('mid'));
            if (isset($moduleConfig[$option])) {
                $retval = $moduleConfig[$option];
            }
        }
    }
    $tbloptions[$option] = $retval;

    return $retval;
}

/**
 * Return if xPartners use an HTML editor
 *
 * @return boolean
 */
function xPartners_isEditorHTML()
{
    global $xoopsModuleConfig;
    if (isset($xoopsModuleConfig['editor']) && in_array($xoopsModuleConfig['editor'], ['tinymce', 'fckeditor', 'koivi', 'inbetween', 'spaw'])) {
        return true;
    }

    return false;
}

/**
 * Redirect to any page inside administration area
 * @param        $url
 * @param int    $time
 * @param string $message
 */
function xPartners_redirect($url, $time = 3, $message = '')
{
    global $xoopsModule;
    if (preg_match("/[\\0-\\31]|about:|script:/i", $url)) {
        if (!preg_match('/^\b(java)?script:([\s]*)history\.go\(-[0-9]*\)([\s]*[;]*[\s]*)$/si', $url)) {
            $url = XOOPS_URL;
        }
    }
    // Create Template instance
    $xoopsTpl = new XoopsTpl();
    // Assign Vars
    $xoopsTpl->assign('url', $url);
    $xoopsTpl->assign('time', $time);
    $xoopsTpl->assign('message', $message);
    $xoopsTpl->assign('ifnotreload', sprintf(_IFNOTRELOAD, $url));
    // Call template file
    echo $xoopsTpl->fetch(XOOPS_ROOT_PATH . '/modules/' . $xoopsModule->getVar('dirname') . '/templates/admin/xpartners_redirect.tpl');
    // Force redirection
    header('refresh: ' . $time . '; url=' . $url);
}
