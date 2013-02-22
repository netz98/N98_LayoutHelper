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
 *
 *  This test needs the following patch in EcomDev_PHPUnit if used with version 0.1.0

app/code/community/EcomDev/PHPUnit/Test/Case.php:


protected function replaceByMock($type, $classAlias, $mock)
{
    if ($mock instanceof PHPUnit_Framework_MockObject_MockBuilder) {
        $mock = $mock->getMock();
    } elseif (!$mock instanceof PHPUnit_Framework_MockObject_MockObject) {
        throw PHPUnit_Util_InvalidArgumentHelper::factory(
            1, 'PHPUnit_Framework_MockObject_MockObject'
        );
    }

// [PATCH BEGIN]
// backported from GitHub !!!!
// Remove addition of /data suffix if version is more than 1.6.x
if (version_compare(Mage::getVersion(), '1.6.0.0', '<') && $type == 'helper'
&& strpos($classAlias, '/') === false
) {
$classAlias .= '/data';
}
// [PATCH END]

 *
 * @copyright  Copyright (c) 2012-2013 netz98 new media GmbH (http://www.netz98.de)
 * @author netz98 new media GmbH <info@netz98.de>
 * @category N98
 * @package N98_LayoutHelper
 */
class N98_LayoutHelper_Test_Block_Sales_Order_Info extends EcomDev_PHPUnit_Test_Case
{

    public function setUp()
    {
        parent::setUp();
        $infoBlock = $this->getBlockMock('payment/info');
        $paymentHelperMock = $this->getHelperMock('payment/data', array('getInfoBlock'));

        $paymentHelperMock->expects($this->any())
            ->method('getInfoBlock')
            ->will($this->returnValue($infoBlock));

        $this->replaceByMock('helper', 'payment', $paymentHelperMock);

        $orderMock = $this->getModelMock('sales/order', array('hasShipments', 'hasCreditmemos'));

        Mage::register('current_order', $orderMock);
    }

    public function tearDown()
    {
        Mage::unregister('current_order');
        parent::tearDown();
    }

    /**
     * @return N98_LayoutHelper_Block_Sales_Order_Info
     */
    protected function getBlock()
    {
        $layout = Mage::getSingleton('core/layout');
        return $layout->createBlock('sales/order_info');
    }

    public function testCreateBlock()
    {
        $block = $this->getBlock();
        $this->assertInstanceOf('N98_LayoutHelper_Block_Sales_Order_Info', $block);
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
