<?php
namespace OrviSoft\AttributeGroups\Model;
/**
 *
 *  @author:    Farhan Islam <farhan@orvisoft.com>
 *  @module:    OrviSoft Attribute Groups (https://github.com/askwhyweb/Attribute-Groups-Magento2)
 *
**/
class Groups extends \Magento\Framework\Model\AbstractModel
{
    /**
     * Initialize resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('OrviSoft\AttributeGroups\Model\ResourceModel\Groups');
    }
}
?>