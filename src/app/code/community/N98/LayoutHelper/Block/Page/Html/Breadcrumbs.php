<?php
/**
 * netz98 magento module
 *
 * LICENSE
 *
 * This source file is subject of netz98.
 * You may be not allowed to change the sources
 * without authorization of netz98 new media GmbH.
 *
 * @copyright  Copyright (c) 2012 netz98 new media GmbH (http://www.netz98.de)
 * @author netz98 new media GmbH <info@netz98.de>
 * @category N98
 * @package N98_LayoutHelper
 */

/**
 * Provides additional function to be called in layout/local.xml
 *
 * @author netz98 new media GmbH <info@netz98.de>
 * @category N98
 * @package N98_LayoutHelper
 */
class N98_LayoutHelper_Block_Page_Html_Breadcrumbs extends Mage_Page_Block_Html_Breadcrumbs
{

    /**
     * Set the original module name avoid breaking translations
     */
    public function __construct()
    {
        parent::__construct();
        $this->setModuleName('Mage_Page');
    }

    /**
     * Add crumb after another
     *
     * @param string $crumbName Name of the crumb
     * @param array $crumbInfo Crumb data
     * @param string $before Insert after crumb name
     */
    public function addCrumb($crumbName, $crumbInfo, $after = false)
    {
        $this->_prepareArray($crumbInfo, array('label', 'title', 'link', 'first', 'last', 'readonly'));
        if ((!isset($this->_crumbs[$crumbName])) || (!$this->_crumbs[$crumbName]['readonly'])) {
            if ($after && isset($this->_crumbs[$after])) {
                $offset = array_search($after, array_keys($this->_crumbs)) + 1;
                $this->_crumbs = array_slice($this->_crumbs, 0, $offset, true) + array($crumbName => $crumbInfo) + array_slice($this->_crumbs, $offset, null, true);
            } else {
                $this->_crumbs[$crumbName] = $crumbInfo;
            }
        }
        return $this;
    }

    /**
     * Add crumb before another
     *
     * @param string $crumbName Name of the crumb
     * @param array $crumbInfo Crumb data
     * @param string $before Insert before crumb name
     */
    public function addCrumbBefore($crumbName, $crumbInfo, $before = false)
    {
        if ($before && isset($this->_crumbs[$before])) {
            $keys = array_keys($this->_crumbs);
            $offset = array_search($before, $keys);
            # add before first
            if (!$offset) {
                $this->_prepareArray($crumbInfo, array('label', 'title', 'link', 'first', 'last', 'readonly'));
                $this->_crumbs = array($crumbName => $crumbInfo) + $this->_crumbs;
            } else {
                $this->addCrumb($crumbName, $crumbInfo, $keys[$offset-1]);
            }
        } else {
            $this->addCrumb($crumbName, $crumbInfo);
        }
    }

    /**
     * Remove a link
     *
     * @param string $name Name of the link
     * @return \N98_LayoutHelper_Block_Page_Html_Breadcrumbs
     */
    public function removeCrumb($crumbName)
    {
        if (isset($this->_crumbs[$crumbName])) {
            unset($this->_crumbs[$crumbName]);
        }
    }
}
