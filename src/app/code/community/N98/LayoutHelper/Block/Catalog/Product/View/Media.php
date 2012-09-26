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
 * @package N98_Catalog
 */

/**
 * Adds remove Link functionality for use in local.xml
 *
 * @author netz98 new media GmbH <info@netz98.de>
 * @category N98
 * @package N98_LayoutHelper
 */
class N98_LayoutHelper_Block_Catalog_Product_View_Media extends Mage_Catalog_Block_Product_View_Media
{
    /**
     * Enable gallery
     */
    public function enableGallery()
    {
        $this->_isGalleryDisabled = false;
    }
}
