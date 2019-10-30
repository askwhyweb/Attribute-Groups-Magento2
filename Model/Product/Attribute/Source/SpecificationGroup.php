<?php
/**
 *
 *  @author:    Farhan Islam <farhan@orvisoft.com>
 *  @module:    OrviSoft Attribute Groups (https://github.com/askwhyweb/Attribute-Groups-Magento2)
 *
**/
namespace OrviSoft\AttributeGroups\Model\Product\Attribute\Source;

class SpecificationGroup extends \Magento\Eav\Model\Entity\Attribute\Source\AbstractSource
{
    protected $_helper;
    public function __construct(
        \OrviSoft\AttributeGroups\Helper\Attributes $helper
    ) {
        $this->_helper = $helper;
    }
    /**
     * getAllOptions
     *
     * @return array
     */
    public function getAllOptions()
    {
        // $this->_options = [
        // ['value' => 'groupa', 'label' => __('GroupA')],
        // ['value' => 'groupb', 'label' => __('GroupB')]
        // ];
        return $this->_helper->getValueArray3();
        //return $this->_options;
    }
}
