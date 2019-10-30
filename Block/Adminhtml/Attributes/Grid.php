<?php
namespace OrviSoft\AttributeGroups\Block\Adminhtml\Attributes;
/**
 *
 *  @author:    Farhan Islam <farhan@orvisoft.com>
 *  @module:    OrviSoft Attribute Groups (https://github.com/askwhyweb/Attribute-Groups-Magento2)
 *
**/
class Grid extends \Magento\Backend\Block\Widget\Grid\Extended
{
    /**
     * @var \Magento\Framework\Module\Manager
     */
    protected $moduleManager;

    /**
     * @var \OrviSoft\AttributeGroups\Model\attributesFactory
     */
    protected $_attributesFactory;

    /**
     * @var \OrviSoft\AttributeGroups\Model\Status
     */
    protected $_status;

    protected $_helper;
    /**
     * @param \Magento\Backend\Block\Template\Context $context
     * @param \Magento\Backend\Helper\Data $backendHelper
     * @param \OrviSoft\AttributeGroups\Model\attributesFactory $attributesFactory
     * @param \OrviSoft\AttributeGroups\Model\Status $status
     * @param \Magento\Framework\Module\Manager $moduleManager
     * @param array $data
     *
     * @SuppressWarnings(PHPMD.ExcessiveParameterList)
     */
    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Backend\Helper\Data $backendHelper,
        \OrviSoft\AttributeGroups\Model\AttributesFactory $AttributesFactory,
        \OrviSoft\AttributeGroups\Model\Status $status,
        \Magento\Framework\Module\Manager $moduleManager,
        array $data = [],
        \OrviSoft\AttributeGroups\Helper\Attributes $helper
    ) {
        $this->_attributesFactory = $AttributesFactory;
        $this->_status = $status;
        $this->moduleManager = $moduleManager;
        parent::__construct($context, $backendHelper, $data);
        $this->_helper = $helper;
    }

    /**
     * @return void
     */
    protected function _construct()
    {
        parent::_construct();
        $this->setId('postGrid');
        $this->setDefaultSort('sort_by');
        $this->setDefaultDir('ASC');
        $this->setSaveParametersInSession(true);
        $this->setUseAjax(false);
        $this->setVarNameFilter('post_filter');
    }

    /**
     * @return $this
     */
    protected function _prepareCollection()
    {
        $collection = $this->_attributesFactory->create()->getCollection();
        $this->setCollection($collection);

        parent::_prepareCollection();

        return $this;
    }

    /**
     * @return $this
     * @SuppressWarnings(PHPMD.ExcessiveMethodLength)
     */
    protected function _prepareColumns()
    {
        $this->addColumn(
            'id',
            [
                'header' => __('ID'),
                'type' => 'number',
                'index' => 'id',
                'header_css_class' => 'col-id',
                'column_css_class' => 'col-id'
            ]
        );

        $this->addColumn(
            'title',
            [
                'header' => __('Title'),
                'index' => 'title',
            ]
        );
				
        $this->addColumn(
            'parent_id',
            [
                'header' => __('Group'),
                'index' => 'parent_id',
                'type' => 'options',
                'options' => $this->_helper->getOptionArray3()
            ]
        );

        $this->addColumn(
            'attributes',
            [
                'header' => __('Attributes'),
                'index' => 'attributes',
            ]
        );

        $this->addColumn(
            'sort_by',
            [
                'header' => __('Sort By'),
                'index' => 'sort_by',
            ]
        );
				
        $this->addColumn(
            'edit',
            [
                'header' => __('Edit'),
                'type' => 'action',
                'getter' => 'getId',
                'actions' => [
                    [
                        'caption' => __('Edit'),
                        'url' => [
                            'base' => '*/*/edit'
                        ],
                        'field' => 'id'
                    ]
                ],
                'filter' => false,
                'sortable' => false,
                'index' => 'stores',
                'header_css_class' => 'col-action',
                'column_css_class' => 'col-action'
            ]
        );
		
        $this->addExportType($this->getUrl('attributegroups/*/exportCsv', ['_current' => true]),__('CSV'));
        $this->addExportType($this->getUrl('attributegroups/*/exportExcel', ['_current' => true]),__('Excel XML'));

        $block = $this->getLayout()->getBlock('grid.bottom.links');
        if ($block) {
            $this->setChild('grid.bottom.links', $block);
        }
        return parent::_prepareColumns();
    }

	
    /**
     * @return $this
     */
    protected function _prepareMassaction()
    {

        $this->setMassactionIdField('id');
        //$this->getMassactionBlock()->setTemplate('OrviSoft_AttributeGroups::attributes/grid/massaction_extended.phtml');
        $this->getMassactionBlock()->setFormFieldName('attributes');

        $this->getMassactionBlock()->addItem(
            'delete',
            [
                'label' => __('Delete'),
                'url' => $this->getUrl('attributegroups/*/massDelete'),
                'confirm' => __('Are you sure?')
            ]
        );

        $statuses = $this->_status->getOptionArray();

        $this->getMassactionBlock()->addItem(
            'status',
            [
                'label' => __('Change status'),
                'url' => $this->getUrl('attributegroups/*/massStatus', ['_current' => true]),
                'additional' => [
                    'visibility' => [
                        'name' => 'status',
                        'type' => 'select',
                        'class' => 'required-entry',
                        'label' => __('Status'),
                        'values' => $statuses
                    ]
                ]
            ]
        );
        return $this;
    }
		

    /**
     * @return string
     */
    public function getGridUrl()
    {
        return $this->getUrl('attributegroups/*/index', ['_current' => true]);
    }

    /**
     * @param \OrviSoft\AttributeGroups\Model\attributes|\Magento\Framework\Object $row
     * @return string
     */
    public function getRowUrl($row)
    {
		return $this->getUrl(
            'attributegroups/*/edit',
            ['id' => $row->getId()]
        );
    }
}