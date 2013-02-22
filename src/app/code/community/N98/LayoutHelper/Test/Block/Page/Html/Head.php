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
class N98_LayoutHelper_Test_Block_Page_Html_Head extends EcomDev_PHPUnit_Test_Case
{
    /**
     * @return N98_LayoutHelper_Block_Page_Html_Head
     */
    protected function getBlock()
    {
        $layout = Mage::getSingleton('core/layout');
        return $layout->createBlock('page/html_head');
    }

    /**
     * Returns the block with two items
     *
     * @return N98_LayoutHelper_Block_Page_Html_Head
     */
    protected function getBlockWithItems()
    {
        $block = $this->getBlock();
        $block->addCss('A');
        $block->addCss('B');
        $block->addCss('C');
        $block->addCss('D');
        return $block;
    }

    public function testCreateBlock()
    {
        $block = $this->getBlock();
        $this->assertInstanceOf('N98_LayoutHelper_Block_Page_Html_Head', $block);
    }

    /**
     * @depends testCreateBlock
     */
    public function testStandard()
    {
        $block = $this->getBlockWithItems();
        $this->assertEquals('skin_css/A,skin_css/B,skin_css/C,skin_css/D', implode(',', array_keys($block->getItems())) );
    }

    /**
     * @depends testStandard
     */
    public function testInsertBetweenAfter()
    {
        $block = $this->getBlockWithItems();
        $block->addCss('test1', '', 'A');
        $this->assertEquals('skin_css/A,skin_css/test1,skin_css/B,skin_css/C,skin_css/D', implode(',', array_keys($block->getItems())) );
        $block->addCss('test2', '', 'D');
        $this->assertEquals('skin_css/A,skin_css/test1,skin_css/B,skin_css/C,skin_css/D,skin_css/test2', implode(',', array_keys($block->getItems())) );
    }

    /**
     * @depends testStandard
     */
    public function testInsertBetweenBefore()
    {
        $block = $this->getBlockWithItems();
        $block->addCss('test1', '', 'B', true);
        $this->assertEquals('skin_css/A,skin_css/test1,skin_css/B,skin_css/C,skin_css/D', implode(',', array_keys($block->getItems())) );
        $block->addCss('test2', '', 'D', true);
        $this->assertEquals('skin_css/A,skin_css/test1,skin_css/B,skin_css/C,skin_css/test2,skin_css/D', implode(',', array_keys($block->getItems())) );
    }

    /**
     * @depends testStandard
     */
    public function testInsertLast()
    {
        $block = $this->getBlockWithItems();
        $block->addCss('last', '', '*', false);
        $this->assertEquals('skin_css/A,skin_css/B,skin_css/C,skin_css/D,skin_css/last', implode(',', array_keys($block->getItems())) );
    }

    /**
     * @depends testStandard
     */
    public function testInsertFirst()
    {
        $block = $this->getBlockWithItems();
        $block->addCss('first', '', '*', true);
        $this->assertEquals('skin_css/first,skin_css/A,skin_css/B,skin_css/C,skin_css/D', implode(',', array_keys($block->getItems())) );
    }

    /**
     * @test
     * @depends testStandard
     */
    public function addCssIe()
    {
        $block = $this->getBlock();
        $block->addCssIe('second');
        $block->addCssIe('first', '', 'second', true);
        $this->assertEquals('skin_css/first,skin_css/second', implode(',', array_keys($block->getItems())) );
    }

    /**
     * @test
     * @depends testStandard
     */
    public function addJs()
    {
        $block = $this->getBlock();
        $block->addJs('second');
        $block->addJs('first', '', 'second', true);
        $this->assertEquals('js/first,js/second', implode(',', array_keys($block->getItems())) );
    }

    /**
     * @test
     * @depends testStandard
     */
    public function addJsIe()
    {
        $block = $this->getBlock();
        $block->addJsIe('second');
        $block->addJsIe('first', '', 'second', true);
        $this->assertEquals('js/first,js/second', implode(',', array_keys($block->getItems())) );
    }


}
