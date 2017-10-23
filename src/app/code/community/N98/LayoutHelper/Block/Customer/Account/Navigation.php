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
 * Adds remove Link functionality for use in local.xml
 *
 * @author netz98 new media GmbH <info@netz98.de>
 * @category N98
 * @package N98_LayoutHelper
 */
class N98_LayoutHelper_Block_Customer_Account_Navigation extends Mage_Customer_Block_Account_Navigation
{
    /**
     * Set the original module name avoid breaking translations
     */
    public function __construct()
    {
        parent::__construct();
        $this->setModuleName('Mage_Customer');
    }

    /**
     * Remove a link
     *
     * @param string $name Name of the link
     * @return \N98_LayoutHelper_Block_Customer_Account_Navigation
     */
    public function removeLink($name)
    {
        if (isset($this->_links[$name])) {
            unset($this->_links[$name]);
        }
        return $this;
    }
}
