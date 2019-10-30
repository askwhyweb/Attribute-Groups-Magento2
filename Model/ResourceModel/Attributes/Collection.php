<?php
/**
 *
 *  @author:    Farhan Islam <farhan@orvisoft.com>
 *  @module:    OrviSoft Attribute Groups (https://github.com/askwhyweb/Attribute-Groups-Magento2)
 *
**/
namespace OrviSoft\AttributeGroups\Model\ResourceModel\Attributes;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{

    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('OrviSoft\AttributeGroups\Model\Attributes', 'OrviSoft\AttributeGroups\Model\ResourceModel\Attributes');
        $this->_map['fields']['page_id'] = 'main_table.page_id';
    }

}
?>