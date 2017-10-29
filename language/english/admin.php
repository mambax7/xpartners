<?php
/**
 * Admin Language File for xPartners
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
 * Form fields
 */
define('_XO_AD_CATEGORY', 'Category');
define('_XO_AD_TITLE', 'Title');
define('_XO_AD_URL', 'Url');
define('_XO_AD_IMAGE', 'Image');
define('_XO_AD_DESCRIPTION', 'Description');
define('_XO_AD_DESCRIPTION_DSC', '');
define('_XO_AD_STATUS', 'Status');
define('_XO_AD_WEIGHT', 'Weight');
define('_XO_AD_ACTIONS', 'Actions');
define('_XO_AD_ACTIVE', 'Active');
define('_XO_AD_INACTIVE', 'Inactive');
define('_XO_AD_TYPE', 'Type');
define('_XO_AD_PARTNER', 'Partner');
define('_XO_AD_DOHTML', 'Show as HTML');
define('_XO_AD_BREAKS', 'Convert Linebreaks to XOOPS breaks');
define('_XO_AD_DOIMAGE', 'Show XOOPS Images');
define('_XO_AD_DOXCODE', 'Show XOOPS Codes');
define('_XO_AD_DOSMILEY', 'Show XOOPS Smilies');

/**
 * Form title
 */
define('_XO_AD_ADD_PARTNER', 'Add Partner');
define('_XO_AD_EDIT_PARTNER', 'Edit Partner');
define('_XO_AD_ADD_CATEGORY', 'Add Category');
define('_XO_AD_EDIT_CATEGORY', 'Edit Category');
/**
 * Messages
 */
define('_XO_AD_WAIT_MESSAGE', 'Please wait a few seconds!');
/**
 * Database and error
 */
define('_XO_AD_PARTNER_SUBERROR', 'We have encountered an Error<br>');
define('_XO_AD_DELETE_PARTNER', 'Are you sure you want to delete this partner ?');
define('_XO_AD_DELETE_CAT', 'Are you sure you want to delete this category and all of its Partners?');
define('_XO_AD_DBSUCCESS', 'Database Updated Successfully!');
define('_XO_AD_ERRORNOCATEGORY', 'Error: No category name given, please go back and enter a category name');
define('_XO_AD_ERRORCOULDNOTADDCAT', 'Error: Could not add category to database.');
define('_XO_AD_ERRORCOULDNOTDELCAT', 'Error: Could not delete requested category.');
define('_XO_AD_ERRORCOULDNOTEDITCAT', 'Error: Could not edit requested item.');
define('_XO_AD_ERRORCOULDNOTDELCONTENTS', 'Error: Could not delete Partner contents.');
define('_XO_AD_ERRORCOULDNOTUPCONTENTS', 'Error: Could not update Partner contents.');
define('_XO_AD_ERRORCOULDNOTADDCONTENTS', 'Error: Could not add Partner contents.');
define('_XO_AD_NOTHTINGTOSHOW', 'No Items To Display');
define('_XO_AD_ERRORNOCAT', 'Error: There are no Categories created yet. Before you can create a new Partner, you must create a Category first.');

// Text for Admin footer
//define("_AM_XPARTNERS_FOOTER", "<div class='center smallsmall italic pad5'>Xpartners is maintained by the <a class='tooltip' rel='external' href='https://xoops.org/' title='Visit XOOPS Community'>XOOPS Community</a></div>");

define('_XO_AD_PARTNER_STATUS_TOGGLE', 'Toggle Status');
define('_XO_AD_PARTNER_STATUS_TOGGLE_SUCCESS', 'Successfully Changed Required Field ');
define('_XO_AD_PARTNER_STATUS_TOGGLE_FAILED', 'Changing Required Field Failed');

//2.01
define('_AM_XPARTNERS_UPGRADEFAILED0', "Update failed - couldn't rename field '%s'");
define('_AM_XPARTNERS_UPGRADEFAILED1', "Update failed - couldn't add new fields");
define('_AM_XPARTNERS_UPGRADEFAILED2', "Update failed - couldn't rename table '%s'");
define('_AM_XPARTNERS_ERROR_COLUMN', 'Could not create column in database : %s');
define('_AM_XPARTNERS_ERROR_BAD_XOOPS', 'This module requires XOOPS %s+ (%s installed)');
define('_AM_XPARTNERS_ERROR_BAD_PHP', 'This module requires PHP version %s+ (%s installed)');
define('_AM_XPARTNERS_ERROR_TAG_REMOVAL', 'Could not remove tags from Tag Module');
