<?php
/**
 * xPartners Partners Class
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

require_once XOOPS_ROOT_PATH . '/kernel/object.php';

class XpartnersPartners extends XoopsObject
{
    /**
     * Constructor
     */
    public function __construct()
    {
        parent::__construct();
        $this->initVar('id', XOBJ_DTYPE_INT, null, false);
        $this->initVar('cat_id', XOBJ_DTYPE_INT, null, false);
        $this->initVar('title', XOBJ_DTYPE_TXTBOX, null, false);
        $this->initVar('description', XOBJ_DTYPE_TXTAREA, null, false);
        $this->initVar('url', XOBJ_DTYPE_TXTBOX, null, true);
        $this->initVar('image', XOBJ_DTYPE_TXTBOX, null, true);
        $this->initVar('weight', XOBJ_DTYPE_INT, 0, false, 10);
        $this->initVar('hits', XOBJ_DTYPE_INT, 0, true, 10);
        $this->initVar('status', XOBJ_DTYPE_INT, 1, false);
        $this->initVar('approve', XOBJ_DTYPE_INT, 1, false);
        //$this->initVar('cat_id', XOBJ_DTYPE_INT, null, false);
        $this->initVar('dohtml', XOBJ_DTYPE_INT);
        $this->initVar('doxcode', XOBJ_DTYPE_INT);
        $this->initVar('dosmiley', XOBJ_DTYPE_INT);
        $this->initVar('doimage', XOBJ_DTYPE_INT);
        $this->initVar('dobr', XOBJ_DTYPE_INT);
    }

    /**
     * Display the partner form for admin area
     * @param string $mode
     */
    public function displayJoinForm($mode = 'add')
    {
        $categoryHandler = xoops_getModuleHandler('category');
        if (!$categoryHandler->getCount()) {
            xoops_error('index.php', 3, _XO_MD_ERRORNOCAT);

            return;
        }
        // Create Form Partner
        $title = _XO_MD_JOIN;
        $form  = new XoopsThemeForm($title, 'partner', 'join.php', 'post', true);
        $form->setExtra('enctype="multipart/form-data"');

        $objects = $categoryHandler->getList();

        $category = new XoopsFormSelect(_XO_AD_CATEGORY, 'cat_id', $this->getVar('cat_id', 'e'), 1, false);
        $category->addOptionArray($objects);
        $form->addElement($category);
        // Title
        $form->addElement(new XoopsFormText(_XO_AD_TITLE, 'title', 50, 50, $this->getVar('title')), true);
        // URL
        $form->addElement(new XoopsFormText(_XO_AD_URL, 'url', 50, 150, $this->getVar('url')), true);
        // Logo
        $form->addElement(new XoopsFormText(_XO_AD_IMAGE, 'image', 50, 150, $this->getVar('image')));
        // Editor
        $editor_tray = new XoopsFormElementTray(_XO_AD_DESCRIPTION, '<br>');
        if (class_exists('XoopsFormEditor')) {
            $configs = [
                'name'   => 'description',
                'value'  => $this->getVar('description'),
                'rows'   => 25,
                'cols'   => '100%',
                'width'  => '100%',
                'height' => '250px',
                'editor' => xPartners_setting('editor')
            ];
            $editor_tray->addElement(new XoopsFormEditor('', 'description', $configs, false, $onfailure = 'textarea'));
        } else {
            $editor_tray->addElement(new XoopsFormDhtmlTextArea('', 'description', $this->getVar('description', 'e'), '100%', '100%'));
        }
        $editor_tray->setDescription(_XO_AD_DESCRIPTION_DSC);
        if (!xPartners_isEditorHTML()) {
            if ($this->isNew()) {
                $this->setVar('dohtml', 0);
                $this->setVar('dobr', 1);
            }
            // HTML
            $html_checkbox = new XoopsFormCheckBox('', 'dohtml', $this->getVar('dohtml', 'e'));
            $html_checkbox->addOption(1, _XO_AD_DOHTML);
            $editor_tray->addElement($html_checkbox);
            // Break line
            $breaks_checkbox = new XoopsFormCheckBox('', 'dobr', $this->getVar('dobr', 'e'));
            $breaks_checkbox->addOption(1, _XO_AD_BREAKS);
            $editor_tray->addElement($breaks_checkbox);
        } else {
            $form->addElement(new xoopsFormHidden('dohtml', 1));
            $form->addElement(new xoopsFormHidden('dobr', 0));
        }
        // Xoops Image
        $doimage_checkbox = new XoopsFormCheckBox('', 'doimage', $this->getVar('doimage', 'e'));
        $doimage_checkbox->addOption(1, _XO_AD_DOIMAGE);
        $editor_tray->addElement($doimage_checkbox);
        // Xoops Code
        $xcodes_checkbox = new XoopsFormCheckBox('', 'doxcode', $this->getVar('doxcode', 'e'));
        $xcodes_checkbox->addOption(1, _XO_AD_DOXCODE);
        $editor_tray->addElement($xcodes_checkbox);
        // Xoops Smiley
        $smiley_checkbox = new XoopsFormCheckBox('', 'dosmiley', $this->getVar('dosmiley', 'e'));
        $smiley_checkbox->addOption(1, _XO_AD_DOSMILEY);
        $editor_tray->addElement($smiley_checkbox);
        // Editor and options
        $form->addElement($editor_tray);
        // Hidden value
        $form->addElement(new XoopsFormHidden('weight', 0));
        $form->addElement(new XoopsFormHidden('status', 0));
        $form->addElement(new XoopsFormHidden('approve', 0));
        $form->addElement(new XoopsFormHidden('id', $this->getVar('id')));
        $form->addElement(new XoopsFormHidden('type', 'partners'));
        $form->addElement(new XoopsFormHidden('op', 'save'));
        $form->addElement(new XoopsFormButton('', 'post', _SUBMIT, 'submit'));
        // Display form
        $form->display();
    }

    /**
     * Display the partner form for admin area
     * @param string $mode
     */
    public function displayAdminForm($mode = 'add')
    {
        $categoryHandler = xoops_getModuleHandler('category');
        if (!$categoryHandler->getCount()) {
            xPartners_redirect('partners.php?op=' . $mode . '&amp;type=category', 3, _XO_AD_ERRORNOCAT);
            xoops_cp_footer();
            exit;
        }
        // Create Form Partner
        $title = ('add' == $mode) ? _XO_AD_ADD_PARTNER : _XO_AD_EDIT_PARTNER;
        $form  = new XoopsThemeForm($title, 'partner', 'partners.php', 'post', true);
        $form->setExtra('enctype="multipart/form-data"');
        // Type
        if ('add' == $mode) {
            $type = new XoopsFormSelect(_XO_AD_TYPE, 'formtype', 'partners');
            $type->addOption('partners', _XO_AD_PARTNER);
            $type->addOption('category', _XO_AD_CATEGORY);
            $type->setExtra("onchange='submit()'");
            $form->addElement($type);
        }
        $objects = $categoryHandler->getList();

        $category = new XoopsFormSelect(_XO_AD_CATEGORY, 'cat_id', $this->getVar('cat_id', 'e'), 1, false);
        $category->addOptionArray($objects);
        $form->addElement($category);
        // Title
        $form->addElement(new XoopsFormText(_XO_AD_TITLE, 'title', 50, 50, $this->getVar('title')), true);
        // URL
        $form->addElement(new XoopsFormText(_XO_AD_URL, 'url', 50, 150, $this->getVar('url')), true);
        // Logo
        $form->addElement(new XoopsFormText(_XO_AD_IMAGE, 'image', 50, 150, $this->getVar('image')), true);
        // Editor
        $editor_tray = new XoopsFormElementTray(_XO_AD_DESCRIPTION, '<br>');
        if (class_exists('XoopsFormEditor')) {
            $configs = [
                'name'   => 'description',
                'value'  => $this->getVar('description'),
                'rows'   => 25,
                'cols'   => '100%',
                'width'  => '100%',
                'height' => '250px',
                'editor' => xPartners_setting('editor')
            ];
            $editor_tray->addElement(new XoopsFormEditor('', 'description', $configs, false, $onfailure = 'textarea'));
        } else {
            $editor_tray->addElement(new XoopsFormDhtmlTextArea('', 'description', $this->getVar('description', 'e'), '100%', '100%'));
        }
        $editor_tray->setDescription(_XO_AD_DESCRIPTION_DSC);
        if (!xPartners_isEditorHTML()) {
            if ($this->isNew()) {
                $this->setVar('dohtml', 0);
                $this->setVar('dobr', 1);
            }
            // HTML
            $html_checkbox = new XoopsFormCheckBox('', 'dohtml', $this->getVar('dohtml', 'e'));
            $html_checkbox->addOption(1, _XO_AD_DOHTML);
            $editor_tray->addElement($html_checkbox);
            // Break line
            $breaks_checkbox = new XoopsFormCheckBox('', 'dobr', $this->getVar('dobr', 'e'));
            $breaks_checkbox->addOption(1, _XO_AD_BREAKS);
            $editor_tray->addElement($breaks_checkbox);
        } else {
            $form->addElement(new xoopsFormHidden('dohtml', 1));
            $form->addElement(new xoopsFormHidden('dobr', 0));
        }
        // Xoops Image
        $doimage_checkbox = new XoopsFormCheckBox('', 'doimage', $this->getVar('doimage', 'e'));
        $doimage_checkbox->addOption(1, _XO_AD_DOIMAGE);
        $editor_tray->addElement($doimage_checkbox);
        // Xoops Code
        $xcodes_checkbox = new XoopsFormCheckBox('', 'doxcode', $this->getVar('doxcode', 'e'));
        $xcodes_checkbox->addOption(1, _XO_AD_DOXCODE);
        $editor_tray->addElement($xcodes_checkbox);
        // Xoops Smiley
        $smiley_checkbox = new XoopsFormCheckBox('', 'dosmiley', $this->getVar('dosmiley', 'e'));
        $smiley_checkbox->addOption(1, _XO_AD_DOSMILEY);
        $editor_tray->addElement($smiley_checkbox);
        // Editor and options
        $form->addElement($editor_tray);
        // Weight
        $form->addElement(new XoopsFormText(_XO_AD_WEIGHT, 'weight', 3, 10, $this->getVar('weight')));
        // Status
        $status = new XoopsFormSelect(_XO_AD_STATUS, 'status', $this->getVar('status'));
        $status->addOption('1', _XO_AD_ACTIVE);
        $status->addOption('0', _XO_AD_INACTIVE);
        $form->addElement($status);
        // Hidden value
        $form->addElement(new XoopsFormHidden('approve', 1));
        $form->addElement(new XoopsFormHidden('id', $this->getVar('id')));
        $form->addElement(new XoopsFormHidden('type', 'partners'));
        $form->addElement(new XoopsFormHidden('op', 'save'));
        $form->addElement(new XoopsFormButton('', 'post', _SUBMIT, 'submit'));
        // Display form
        $form->display();
    }
}

/**
 * XpartnersPartnersHandler
 *
 * @package     Xpartners
 * @author      Andricq Nicolas (AKA MusS)
 * @copyright   Copyright (c) 2009
 * @access      public
 */
class XpartnersPartnersHandler extends XoopsPersistableObjectHandler
{
    /**
     * Constructor
     *
     * @param null|XoopsDatabase $db
     */
    public function __construct(XoopsDatabase $db)
    {
        parent::__construct($db, 'partners', 'XpartnersPartners', 'id', 'title');
    }

    /**
     * Return the list of partners order by weight
     * @return bool
     */
    public function &getObj()
    {
        $obj          = false;
        $criteria     = new CriteriaCompo();
        $obj['count'] = $this->getCount($criteria);
        if (!empty($args[0])) {
            $criteria->setSort('ASC');
            $criteria->setOrder('weight');
            $criteria->setStart(0);
            $criteria->setLimit(0);
        }
        $obj['list'] = $this->getObjects($criteria, false);

        return $obj;
    }

    /**
     * Return the list of partners for a category
     *
     * @param string $id
     * @return bool
     */
    public function &getByCategory($id = '')
    {
        $obj      = false;
        $criteria = new CriteriaCompo();
        if (isset($id)) {
            $criteria->add(new Criteria('cat_id', $id, '='));
        }
        $obj['count'] = $this->getCount($criteria);
        if (!empty($args[0])) {
            $criteria->setSort('ASC');
            $criteria->setOrder('weight');
            $criteria->setStart(0);
            $criteria->setLimit(0);
        }
        $obj['list'] = $this->getObjects($criteria, false);

        return $obj;
    }

    /**
     * Return active partner
     *
     * @param string $id
     * @return bool
     */
    public function &getActive($id = '')
    {
        $obj      = false;
        $criteria = new CriteriaCompo();
        if (isset($id)) {
            $criteria->add(new Criteria('cat_id', $id, '='));
        }
        $obj['count'] = $this->getCount($criteria);
        if (!empty($args[0])) {
            $criteria->setSort('ASC');
            $criteria->setOrder('title');
        }
        $obj['list'] = $this->getObjects($criteria, false);

        return $obj;
    }

    /**
     * Update counter when user click on link
     * @param $id
     */
    public function setHits($id)
    {
        $db = XoopsDatabaseFactory::getDatabaseConnection();
        $db->queryF('UPDATE ' . $db->prefix('xpartners') . " SET hits=hits+1 WHERE id=$id");
    }
}
