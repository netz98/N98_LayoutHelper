<?php

class N98_LayoutHelper_Block_Customer_Widget_Name extends Mage_Customer_Block_Widget_Name
{
    /**
     * do not show an empty prefix option;
     *
     * @return array|bool
     */
    public function getPrefixOptions()
    {
        $options = parent::getPrefixOptions();
        if(is_array($options)){
            if(isset($options[''])){
                unset($options['']);
                $keys = array_keys($options);
                $object = $this->getObject()->setPrefix($options[$keys[0]]);
            }
        }
        return $options;
    }
}