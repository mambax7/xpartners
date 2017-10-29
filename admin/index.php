<?php
/**
 * XpartnersAdministration
 *
 * @copyright::    XOOPS Project (https://xoops.org)
 * @license  ::   http://www.fsf.org/copyleft/gpl.html GNU public license
 * @package  ::   xpartners
 * @since    ::        1.11
 * @author   ::    Raul Recio (aka UNFOR)
 */

require_once __DIR__ . '/admin_header.php';
xoops_cp_header();

$adminObject = \Xmf\Module\Admin::getInstance();

//-----------------------
$xpPartnerHandler = xoops_getModuleHandler('partners', $xoopsModule->getVar('dirname', 'n'));

$totalPartners          = $xpPartnerHandler->getCount();
$totalNonActivePartners = $xpPartnerHandler->getCount(new Criteria('status', 0, '='));
$totalActivePartners    = $totalPartners - $totalNonActivePartners;

$adminObject->addInfoBox(_MD_XPARTNERS_DASHBOARD);

$adminObject->addInfoBoxLine(sprintf( '<infolabel>' . _MD_XPARTNERS_TOTALACTIVE . '</infolabel>', $totalActivePartners), '', 'Green');
$adminObject->addInfoBoxLine(sprintf( '<infolabel>' . _MD_XPARTNERS_TOTALNONACTIVE . '</infolabel>', $totalNonActivePartners), '', 'Red');
$adminObject->addInfoBoxLine(sprintf( '<infolabel>' . _MD_XPARTNERS_TOTALPARTNERS . '</infolabel><infotext>', $totalPartners . '</infotext>'), '');
//----------------------------

$adminObject->displayNavigation(basename(__FILE__));
$adminObject->displayIndex();

require_once __DIR__ . '/admin_footer.php';
