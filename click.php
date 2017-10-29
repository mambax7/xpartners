<?php
/**
 * Click page for the xPartners Module
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

$partnersHandler = xoops_getModuleHandler('partners');

$id = xPartners_CleanVars($_REQUEST, 'id', 0, 'int');

if (!isset($_COOKIE['partners' . $id])) {
    setcookie('partners' . $id, $id, time() + xPartners_setting('cookietime'));
    $partnersHandler->setHits($id);
}
// Include footer
require_once __DIR__ . '/footer.php';
