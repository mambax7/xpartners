<?php
/**
 * Admin Index File for xPartners
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
require_once __DIR__ . '/admin_header.php';

$adminObject = \Xmf\Module\Admin::getInstance();

// Display Xoops header
xoops_cp_header();
$adminObject->displayNavigation('main.php?op=default');
$adminObject->addItemButton(_MI_XPARTNERS_ADMIN_ADD_CATEGORY, 'partners.php?op=add&amp;type=category', 'add', '');
$adminObject->displayButton('left', '');
// Diplay navigation menu
//$menuHandler->render(0);

$objects = $categoryHandler->getObj();
if ($objects['count'] > 0) {
    foreach ($objects['list'] as $object) {
        $category         = [];
        $category['id']   = $object->getVar('cat_id');
        $category['name'] = $object->getVar('cat_title');
        $category['desc'] = $object->getVar('cat_description');

        $contentsObj = $partnersHandler->getByCategory($object->getVar('cat_id'));
        if ($contentsObj['count']) {
            foreach ($contentsObj['list'] as $content) {
                $category['partners'][] = $content->toArray();
            }
        }
        $xoopsTpl->append_by_ref('categories', $category);
        unset($category);
    }
}
// Call template file
echo $xoopsTpl->fetch(XOOPS_ROOT_PATH . '/modules/' . $xoopsModule->getVar('dirname') . '/templates/admin/xpartners_main.tpl');

// Display Xoops footer
require_once __DIR__ . '/admin_footer.php';
//xoops_cp_footer();
