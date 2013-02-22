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
 * @copyright  Copyright (c) 2012-2013 netz98 new media GmbH (http://www.netz98.de)
 * @author netz98 new media GmbH <info@netz98.de>
 * @category N98
 * @package N98_LayoutHelper
 */
class N98_LayoutHelper_Test_Block_Customer_Account_Navigation extends EcomDev_PHPUnit_Test_Case
{

    /**
     * @return N98_LayoutHelper_Block_Customer_Account_Navigation
     */
    protected function getBlock()
    {
        $layout = Mage::getSingleton('core/layout');
        return $layout->createBlock('customer/account_navigation');
    }

    public function testCreateBlock()
    {
        $block = $this->getBlock();
        $this->assertInstanceOf('N98_LayoutHelper_Block_Customer_Account_Navigation', $block);
    }

    /**
     * @test
     */
    public function removeLink()
    {
        $block = $this->getBlock();
        $block->addLink('removeme', '/foo', 'Remove Me');
        $block->addLink('some', '/bar', 'Some Link');
        $this->assertArrayHasKey('removeme', $block->getLinks());
        $this->assertArrayHasKey('some', $block->getLinks());

        $block->removeLink('removeme');
        $this->assertArrayNotHasKey('removeme', $block->getLinks());
        $this->assertArrayHasKey('some', $block->getLinks());
    }
}
