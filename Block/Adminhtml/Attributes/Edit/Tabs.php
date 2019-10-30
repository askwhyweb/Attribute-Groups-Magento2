<?php
namespace OrviSoft\AttributeGroups\Block\Adminhtml\Attributes\Edit;
/**
 *
 *  @author:    Farhan Islam <farhan@orvisoft.com>
 *  @module:    OrviSoft Attribute Groups (https://github.com/askwhyweb/Attribute-Groups-Magento2)
 *
**/
/**
 * Admin page left menu
 */
class Tabs extends \Magento\Backend\Block\Widget\Tabs
{
    /**
     * @return void
     */
    protected function _construct()
    {
        parent::_construct();
        $this->setId('attributes_tabs');
        $this->setDestElementId('edit_form');
        $this->setTitle(__('Attributes Information'));
    }
}