<?php
/**
 * Admin Partners managment for xPartners
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

// Get default variables
$op   = xPartners_CleanVars($_REQUEST, 'op', 'add', 'string');
$type = xPartners_CleanVars($_REQUEST, 'type', 'partners', 'string');

// Display Xoops header
xoops_cp_header();
//$adminObject->displayNavigation(basename(__FILE__));
//$adminObject->addItemButton(_MI_XPARTNERS_ADMIN_ADDP, 'partners.php?op=add&amp;type=partners', 'add', '');
//$adminObject->displayButton('right', '');

// Change form
if (!isset($_POST['post']) && isset($_POST['formtype'])) {
    // Diplay navigation menu
    //$menuHandler->render(1);
    //$adminObject->displayNavigation('partners.php?op=add&type=partners');
    // Redirect to other type
    xPartners_redirect('partners.php?op=add&amp;type=' . $_POST['formtype'], 0, _XO_AD_WAIT_MESSAGE);
    // Include footer
    require_once __DIR__ . '/admin_footer.php';
    //xoops_cp_footer();
    // Quit procedure
    exit;
}
// Load Partner/Category Handler
$partnersHandler = xoops_getModuleHandler($type);
// Retreive form data for all case
switch ($op) {
    case 'add': // Add Partner/Category
        // Diplay navigation menu
        //$menuHandler->render(1);
        //$adminObject->displayNavigation('partners.php?op=add&type=partners');
        $obj = $partnersHandler->create();
        $obj->displayAdminForm();
        $adminObject->displayNavigation('partners.php?op=add&type=partners');
        break;

    case 'edit': // Edit Partner/Category
        // Diplay navigation menu
        //$menuHandler->render(1);
        //$adminObject->displayNavigation('partners.php?op=add&type=partners');
        $id  = xPartners_CleanVars($_REQUEST, 'id', 0, 'int');
        $obj = $partnersHandler->get($id);
        $obj->displayAdminForm($op);
        break;

    case 'save':
        if (!$GLOBALS['xoopsSecurity']->check()) {
            redirect_header('main.php', 0, $GLOBALS['xoopsSecurity']->getErrors(true));
        }
        // Diplay navigation menu
        //$menuHandler->render(1);
        //$adminObject->displayNavigation('partners.php?op=add&type=partners');
        $id  = xPartners_CleanVars($_REQUEST, $partnersHandler->keyName, 0, 'int');
        $obj = (0 == $id) ? $partnersHandler->create() : $partnersHandler->get($id);
        if (is_object($obj)) {
            $obj->setVars($_REQUEST);
            $obj->setVar('dohtml', isset($_REQUEST['dohtml']) ? 1 : 0);
            $obj->setVar('dosmiley', isset($_REQUEST['dosmiley']) ? 1 : 0);
            $obj->setVar('doxcode', isset($_REQUEST['doxcode']) ? 1 : 0);
            $obj->setVar('doimage', isset($_REQUEST['doimage']) ? 1 : 0);
            $obj->setVar('dobr', isset($_REQUEST['dobr']) ? 1 : 0);
            $ret = $partnersHandler->insert($obj, true);
            if ($ret) {
                xPartners_redirect('main.php', 1, _XO_AD_DBSUCCESS);
                // Display Xoops footer
                xoops_cp_footer();
                exit;
            }
        } else {
            // Display Error
            xoops_error($ret, _XO_AD_PARTNER_SUBERROR);
        }
        break;

    case 'toggle':
        if (isset($_REQUEST['id'])) {
            $id = (int)$_REQUEST['id'];
            if (isset($_REQUEST['status'])) {
                $status = (int)$_REQUEST['status'];
                xpartners_status_toggle($id, $status);
            }
        }
        break;

    case 'delete': // Delete Partner/Category
        $ok = xPartners_CleanVars($_REQUEST, 'ok', 0, 'int');
        $id = xPartners_CleanVars($_REQUEST, 'id', 0, 'int');

        if (1 == $ok) {
            $id  = xPartners_CleanVars($_REQUEST, $partnersHandler->keyName, 0, 'int');
            $obj = $partnersHandler->get($id);
            if (is_object($obj)) {
                // if category, first delete all partners for this category
                if ('category' == $type) {
                    $partnerHandler = xoops_getModuleHandler('partners');
                    $criteria       = new CriteriaCompo();
                    $criteria->add(new Criteria('cat_id', $id));
                    $partnersArray = $partnerHandler->getAll($criteria);

                    foreach (array_keys($partnersArray) as $i) {
                        $partnerHandler->delete($partnerHandler->get($i));
                    }
                }
                if ($partnersHandler->delete($obj)) {
                    xPartners_redirect('main.php', 1, _XO_AD_DBSUCCESS);
                    // Display Xoops footer
                    require_once __DIR__ . '/admin_footer.php';
                    //xoops_cp_footer();
                }
            }
        } else {
            // Diplay navigation menu
            //$menuHandler->render(0);
            //$adminObject->displayNavigation('partners.php?op=add&type=partners');
            $obj = $partnersHandler->get($id);
            //confirm to delete (checks if it's Partner or Category
            $message = ('partners' == $type) ? _XO_AD_DELETE_PARTNER : _XO_AD_DELETE_CAT;
            $message .= '<div class="txtcenter">' . $obj->getVar($partnersHandler->identifierName, 's') . '</div>';
            xoops_confirm([
                              'type'                    => $type,
                              'op'                      => 'delete',
                              $partnersHandler->keyName => $id,
                              'ok'                      => 1
                          ], 'partners.php', $message);
        }
        break;
}

function xpartners_status_toggle($id, $status)
{
    $status      = (1 == $status) ? 0 : 1;
    $thisHandler = xoops_getModuleHandler('partners', 'xpartners');
    $obj         = $thisHandler->get($id);
    $obj->setVar('status', $status);
    if ($thisHandler->insert($obj, true)) {
        redirect_header('main.php', 1, _XO_AD_PARTNER_STATUS_TOGGLE_SUCCESS);
    } else {
        redirect_header('main.php', 1, _XO_AD_PARTNER_STATUS_TOGGLE_FAILED);
    }
}

// Display Xoops footer
require_once __DIR__ . '/admin_footer.php';
//xoops_cp_footer();
