<?php
/**
 * Module update page
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

// defined('XOOPS_ROOT_PATH') || exit('Restricted access.');

/**
 * Function executed during an update of the module
 *
 * @String  XoopsModule $module  array of the module
 * @param XoopsModule $module
 * @return bool
 */
function xoops_module_update_xpartners(XoopsModule $module)
{
    global $xoopsConfig, $xoopsDB, $xoopsUser, $xoopsModule;

    if (!partners_fieldExists('cat_id', $xoopsDB->prefix('xpartners'))) {
        $result = $xoopsDB->queryF('ALTER TABLE `' . $xoopsDB->prefix('xpartners') . "` ADD `cat_id` INT( 10 ) NOT NULL DEFAULT '0' AFTER `status`");
    }
    if (!partners_fieldExists('dohtml', $xoopsDB->prefix('xpartners'))) {
        $result = $xoopsDB->queryF('ALTER TABLE `' . $xoopsDB->prefix('xpartners') . "` ADD `dohtml` TINYINT( 1 ) NOT NULL DEFAULT '1' AFTER `cat_id`");
    }
    if (!partners_fieldExists('doxcode', $xoopsDB->prefix('xpartners'))) {
        $result = $xoopsDB->queryF('ALTER TABLE `' . $xoopsDB->prefix('xpartners') . "` ADD `doxcode` TINYINT( 1 ) NOT NULL DEFAULT '1' AFTER `dohtml`");
    }
    if (!partners_fieldExists('dosmiley', $xoopsDB->prefix('xpartners'))) {
        $result = $xoopsDB->queryF('ALTER TABLE `' . $xoopsDB->prefix('xpartners') . "` ADD `dosmiley` TINYINT( 1 ) NOT NULL DEFAULT '1' AFTER `doxcode`");
    }
    if (!partners_fieldExists('doimage', $xoopsDB->prefix('xpartners'))) {
        $result = $xoopsDB->queryF('ALTER TABLE `' . $xoopsDB->prefix('xpartners') . "` ADD `doimage` TINYINT( 1 ) NOT NULL DEFAULT '1' AFTER `dosmiley`");
    }
    if (!partners_fieldExists('dobr', $xoopsDB->prefix('xpartners'))) {
        $result = $xoopsDB->queryF('ALTER TABLE `' . $xoopsDB->prefix('xpartners') . "` ADD `dobr` TINYINT( 1 ) NOT NULL DEFAULT '0' AFTER `doimage`");
    }
    if (!partners_fieldExists('approve', $xoopsDB->prefix('xpartners'))) {
        $result = $xoopsDB->queryF('ALTER TABLE `' . $xoopsDB->prefix('xpartners') . "` ADD `approve` TINYINT( 1 ) NOT NULL DEFAULT '0' AFTER `status`");
    }

    return true;
}

/**
 * Check if table already exist in mysql
 *
 * @String  $tablename  name of the table with the Xoops DB prefix
 * @param $tablename
 * @return bool
 */
function content_table_exists($tablename)
{
    global $xoopsDB;
    $result = $xoopsDB->queryF("SHOW TABLES LIKE '$tablename'");

    return ($xoopsDB->getRowsNum($result) > 0);
}

/**
 * Check if field already exist in table
 *
 * @String  $fieldname  name of the field
 * @String  $table      name of the table with the Xoops DB prefix
 * @param $fieldname
 * @param $table
 * @return bool
 */
function partners_fieldExists($fieldname, $table)
{
    global $xoopsDB;
    $result = $xoopsDB->queryF("SHOW COLUMNS FROM   $table LIKE '$fieldname'");

    return ($xoopsDB->getRowsNum($result) > 0);
}
