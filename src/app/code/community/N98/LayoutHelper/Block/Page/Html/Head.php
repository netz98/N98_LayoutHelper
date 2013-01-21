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
class N98_LayoutHelper_Block_Page_Html_Head extends Mage_Page_Block_Html_Head
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
     * Functionality @see Mage_Page_Block_Html_Head
     * Adds to parameters to influence the ordering
     *
     * @param string $type @see Mage_Page_Block_Html_Head
     * @param string $name @see Mage_Page_Block_Html_Head
     * @param null $params @see Mage_Page_Block_Html_Head
     * @param null $if @see Mage_Page_Block_Html_Head
     * @param null $cond @see Mage_Page_Block_Html_Head
     * @param string $referenceName name of the item to insert the element before. If name is not found, insert at the end, * has special meaning (before all / before all)
     * @param bool $before If true insert before the $referenceName instead of after
     * @return N98_LayoutHelper_Block_Page_Html_Head
     */
    public function addItem($type, $name, $params=null, $if=null, $cond=null, $referenceName="*", $before=false)
    {
        // allow skipping of parameters in the layout XML files via empty-string
        if ($params == '') {
            $params = null;
        }
        if ($if == '') {
            $if = null;
        }
        if ($cond == '') {
            $cond = null;
        }

        parent::addItem($type, $name, $params, $if, $cond);

        // that is the standard behaviour
        if ($referenceName == '*' && $before == false) {
            return $this;
        }

        $this->_sortItems($referenceName, $before, $type);

        return $this;
    }

    /**
     * @param string $referenceName
     * @param string $before
     * @param string $type
     */
    protected function _sortItems($referenceName, $before, $type)
    {
        $items = $this->_data['items'];

        // get newly inserted item so we do not have to reproduce the functionality of the parent
        end($items);
        $newKey = key($items);
        $newVal = array_pop($items);

        $newItems = array();

        if ($referenceName == '*' and $before == true) {
            $newItems[$newKey] = $newVal;
        }

        $referenceName = $type . '/' . $referenceName;
        foreach ($items as $key => $value) {
            if ($key == $referenceName && $before == true) {
                $newItems[$newKey] = $newVal;
            }

            $newItems[$key] = $value;

            if ($key == $referenceName && $before == false) {
                $newItems[$newKey] = $newVal;
            }
        }

        // replace items only if the reference was found (otherwise insert as last item)
        if (isset($newItems[$newKey])) {
            $this->_data['items'] = $newItems;
        }
    }

    /**
     * Functionality @see Mage_Page_Block_Html_Head
     * Adds to parameters to influence the ordering @see addItem
     *
     * @param string $name @see Mage_Page_Block_Html_Head
     * @param string $params @see Mage_Page_Block_Html_Head
     * @param $referenceName @see addItem
     * @param $before @see addItem
     * @return N98_LayoutHelper_Block_Page_Html_Head
     */
    public function addCss($name, $params = "", $referenceName = "*", $before = null)
    {
        $this->addItem('skin_css', $name, $params, null, null, $referenceName, $before);
        return $this;
    }

    /**
     * Functionality @see Mage_Page_Block_Html_Head
     * Adds to parameters to influence the ordering @see addItem
     *
     * @param string $name @see Mage_Page_Block_Html_Head
     * @param string $params @see Mage_Page_Block_Html_Head
     * @param $referenceName @see addItem
     * @param $before @see addItem
     * @return N98_LayoutHelper_Block_Page_Html_Head
     */
    public function addCssIe($name, $params = "", $referenceName = "*", $before = null)
    {
        $this->addItem('skin_css', $name, $params, 'IE', null, $referenceName, $before);
        return $this;
    }

    /**
     * Functionality @see Mage_Page_Block_Html_Head
     * Adds to parameters to influence the ordering @see addItem
     *
     * @param string $name @see Mage_Page_Block_Html_Head
     * @param string $params @see Mage_Page_Block_Html_Head
     * @param $referenceName @see addItem
     * @param $before @see addItem
     * @return N98_LayoutHelper_Block_Page_Html_Head
     */
    public function addJs($name, $params = "", $referenceName = "*", $before = null)
    {
        $this->addItem('js', $name, $params, null, null, $referenceName, $before);
        return $this;
    }

    /**
     * Functionality @see Mage_Page_Block_Html_Head
     * Adds to parameters to influence the ordering @see addItem
     *
     * @param string $name @see Mage_Page_Block_Html_Head
     * @param string $params @see Mage_Page_Block_Html_Head
     * @param $referenceName @see addItem
     * @param $before @see addItem
     * @return N98_LayoutHelper_Block_Page_Html_Head
     */
    public function addJsIe($name, $params = "", $referenceName = "*", $before = null)
    {
        $this->addItem('js', $name, $params, 'IE', null, $referenceName, $before);
        return $this;
    }

}
