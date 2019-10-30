<?php
/**
 *
 *  @author:    Farhan Islam <farhan@orvisoft.com>
 *  @module:    OrviSoft Attribute Groups (https://github.com/askwhyweb/Attribute-Groups-Magento2)
 *
**/
namespace OrviSoft\AttributeGroups\Block\Adminhtml\Attributes\Edit\Tab;

/**
 * Attributes edit form main tab
 */
class Main extends \Magento\Backend\Block\Widget\Form\Generic implements \Magento\Backend\Block\Widget\Tab\TabInterface
{
    /**
     * @var \Magento\Store\Model\System\Store
     */
    protected $_systemStore;

    /**
     * @var \OrviSoft\AttributeGroups\Model\Status
     */
    protected $_status;
    protected $_helper;
    /**
     * @param \Magento\Backend\Block\Template\Context $context
     * @param \Magento\Framework\Registry $registry
     * @param \Magento\Framework\Data\FormFactory $formFactory
     * @param \Magento\Store\Model\System\Store $systemStore
     * @param array $data
     */
    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Framework\Registry $registry,
        \Magento\Framework\Data\FormFactory $formFactory,
        \Magento\Store\Model\System\Store $systemStore,
        \OrviSoft\AttributeGroups\Model\Status $status,
        array $data = [],
        \OrviSoft\AttributeGroups\Helper\Attributes $helper
    ) {
        $this->_systemStore = $systemStore;
        $this->_status = $status;
        parent::__construct($context, $registry, $formFactory, $data);
        $this->_helper = $helper;
    }

    /**
     * Prepare form
     *
     * @return $this
     * @SuppressWarnings(PHPMD.ExcessiveMethodLength)
     */
    protected function _prepareForm()
    {
        /* @var $model \OrviSoft\AttributeGroups\Model\BlogPosts */
        $model = $this->_coreRegistry->registry('attributes');

        $isElementDisabled = false;

        /** @var \Magento\Framework\Data\Form $form */
        $form = $this->_formFactory->create();

        $form->setHtmlIdPrefix('page_');

        $fieldset = $form->addFieldset('base_fieldset', ['legend' => __('Item Information')]);

        if ($model->getId()) {
            $fieldset->addField('id', 'hidden', ['name' => 'id']);
        }

        $fieldset->addField(
            'title',
            'text',
            [
                'name' => 'title',
                'label' => __('Title'),
                'title' => __('Title'),
				'required' => true,
                'disabled' => $isElementDisabled
            ]
        );
					

        $fieldset->addField(
            'parent_id',
            'select',
            [
                'label' => __('Group'),
                'title' => __('Group'),
                'name' => 'parent_id',
				'required' => true,
                'options' => $this->_helper->getOptionArray3(),
                'disabled' => $isElementDisabled
            ]
        );

        $fieldset->addField(
            'sort_by',
            'text',
            [
                'name' => 'sort_by',
                'label' => __('Sort By'),
                'title' => __('Sort By'),
				'required' => true,
                'disabled' => $isElementDisabled,
                'value'  => '0',
                'class' => 'validate-number'
            ]
        );
					
        $fieldset->addField(
            'attributes',
            'multiselect',
            [
                'label' => __('Attributes'),
                'title' => __('Attributes'),
                'name' => 'attributes',
                'required' => true,
                'class' => 'main_acount',
                'values' => $this->_helper->getValueArray5(),
                'disabled' => $isElementDisabled
            ]
        );

        if (!$model->getId()) {
            $model->setData('is_active', $isElementDisabled ? '0' : '1');
        }

        $form->setValues($model->getData());
        $this->setForm($form);

        return parent::_prepareForm();
    }

    /**
     * Prepare label for tab
     *
     * @return \Magento\Framework\Phrase
     */
    public function getTabLabel()
    {
        return __('Item Information');
    }

    /**
     * Prepare title for tab
     *
     * @return \Magento\Framework\Phrase
     */
    public function getTabTitle()
    {
        return __('Item Information');
    }

    /**
     * {@inheritdoc}
     */
    public function canShowTab()
    {
        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function isHidden()
    {
        return false;
    }

    /**
     * Check permission for passed action
     *
     * @param string $resourceId
     * @return bool
     */
    protected function _isAllowedAction($resourceId)
    {
        return $this->_authorization->isAllowed($resourceId);
    }

    public function getTargetOptionArray(){
    	return array(
    				'_self' => "Self",
					'_blank' => "New Page",
    				);
    }
}
