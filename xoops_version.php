<?php
/**
 * Module main page
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
 * Module configs
 */
$modversion = [
    'version'             => 2.01,
    'module_status'       => 'Beta 1',
    'release_date'        => '2014/04/23',
    'name'                => _XO_MI_XPARTNERS_NAME,
    'description'         => _XO_MI_XPARTNERS_DESC,
    'official'            => 0,
    'author'              => 'Raul Recio (AKA UNFOR), Andricq Nicolas (AKA MusS)',
    'credits'             => 'The Xoops Module Development Team, Mage, Mamba, ZySpec',
    'license'             => 'GNU GPL 2.0',
    'license_url'         => 'www.gnu.org/licenses/gpl-2.0.html',
    'help'                => 'page=help',
    'contributors'        => '',
    'image'               => 'assets/images/logoModule.png',
    'website_url'         => 'https://xoops.org',
    'dirname'             => basename(__DIR__),

    //about
    'author_website_url'  => 'https://xoops.org',
    'author_website_name' => 'XOOPS',
    'module_website_url'  => 'https://xoops.org',
    'module_website_name' => 'XOOPS',
    'min_php'             => '5.5',
    'min_xoops'           => '2.5.9',
    'min_db'              => ['mysql' => '5.5'],
    'min_admin'           => '1.1',
    //    'dirmoduleadmin'      => '/Frameworks/moduleclasses/moduleadmin',
    //    'icons16'             => '../../Frameworks/moduleclasses/icons/16',
    //    'icons32'             => '../../Frameworks/moduleclasses/icons/32'
    // Local path icons
    'modicons16'          => 'assets/images/icons/16',
    'modicons32'          => 'assets/images/icons/32',

];

/**
 * Module Sql
 */
$modversion['sqlfile']['mysql'] = 'sql/mysql.sql';

/**
 * Module SQL Tables
 */
$modversion['tables'] = ['xpartners', 'xpartners_category'];

/**
 * Module Update
 */
$modversion['onUpdate'] = 'include/update.php';

/**
 * Module Admin
 */
$modversion['hasAdmin']    = 1;
$modversion['adminindex']  = 'admin/index.php';
$modversion['adminmenu']   = 'admin/menu.php';
$modversion['system_menu'] = 1;

/**
 * Module Main
 */
$modversion['hasMain'] = 1;
global $xoopsUser;
if ($xoopsUser) {
    $modversion['sub'][1]['name'] = _XO_MI_MENU_JOIN;
    $modversion['sub'][1]['url']  = 'join.php';
}
/**
 * Module Search
 */
//$modversion['hasSearch'] = 1;
//$modversion['search']['file'] = 'include/search.inc.php';
//$modversion['search']['func'] = 'xpartners_search';

// ------------------- Help files ------------------- //
$modversion['helpsection'] = [
    ['name' => _MI_XPARTNERS_OVERVIEW, 'link' => 'page=help'],
    ['name' => _MI_XPARTNERS_DISCLAIMER, 'link' => 'page=disclaimer'],
    ['name' => _MI_XPARTNERS_LICENSE, 'link' => 'page=license'],
    ['name' => _MI_XPARTNERS_SUPPORT, 'link' => 'page=support'],
];

/**
 * Module Templates
 */
$modversion['templates'][] = [
    'file'        => 'xpartners_header.tpl',
    'description' => 'Header template'
];
$modversion['templates'][] = [
    'file'        => 'xpartners_index.tpl',
    'description' => 'Partners main Screen'
];
$modversion['templates'][] = [
    'file'        => 'xpartners_category.tpl',
    'description' => 'Dsiplay partner category'
];
$modversion['templates'][] = [
    'file'        => 'xpartners_join.tpl',
    'description' => 'Shows Join to the partners Form'
];

/**
 * Module Comments
 */
//$modversion['hasComments'] = 1;
//$modversion['comments'][] = array( 'pageName' => 'index.php', 'itemName' => 'cat_id' );

/**
 * Module blocks
 */
$modversion['blocks'][] = [
    'file'        => 'partners.php',
    'name'        => _XO_MI_XPARTNERS_NAME,
    'description' => _XO_MI_XPARTNERS_DESC,
    'show_func'   => 'b_xPartners_show',
    'edit_func'   => 'b_xPartners_edit',
    'options'     => '0',
    'template'    => 'xpartners_block_site.tpl'
];

/**
 * Module configs
 */
xoops_load('xoopslists');

$modversion['config'][] = [
    'name'        => 'editor',
    'title'       => '_XO_MI_XPARTNERS_EDITOR',
    'description' => '_XO_MI_XPARTNERS_EDITOR_DESC',
    'formtype'    => 'select',
    'valuetype'   => 'text',
    'default'     => 'dhtmltextarea',
    'options'     => XoopsLists::getDirListAsArray(XOOPS_ROOT_PATH . '/class/xoopseditor')
];
$modversion['config'][] = [
    'name'        => 'cookietime',
    'title'       => '_XO_MI_XPARTNERS_RECLICK',
    'description' => '_XO_MI_XPARTNERS_RECLICK_DESC',
    'formtype'    => 'select',
    'valuetype'   => 'int',
    'default'     => 86400,
    'options'     => [
        '_XO_MI_XPARTNERS_HOUR'    => '3600',
        '_XO_MI_XPARTNERS_3HOURS'  => '10800',
        '_XO_MI_XPARTNERS_5HOURS'  => '18000',
        '_XO_MI_XPARTNERS_10HOURS' => '36000',
        '_XO_MI_XPARTNERS_DAY'     => '86400'
    ]
];
