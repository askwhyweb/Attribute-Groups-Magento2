<?php
/**
 *
 *  @author:    Farhan Islam <farhan@orvisoft.com>
 *  @module:    OrviSoft Attribute Groups (https://github.com/askwhyweb/Attribute-Groups-Magento2)
 *
**/
namespace OrviSoft\AttributeGroups\Helper;

use Magento\Framework\App\Helper\AbstractHelper;

class Attributes extends AbstractHelper
{
    /**
     * @var \Magento\Framework\Api\SearchCriteriaBuilder
     */
    protected $searchCriteriaBuilder;

    /**
     * @var \Magento\Eav\Api\AttributeRepositoryInterface
     */
    protected $attributeRepository;

    /**
     * @var \OrviSoft\AttributeGroups\Model\groupsFactory
     */
    protected $_groupsFactory;

    /**
     * @var \OrviSoft\AttributeGroups\Model\attributesFactory
     */
    protected $_attributesFactory;

    /**
     * @var \Magento\Framework\App\Config\ScopeConfigInterface
     */
    protected $scopeConfig;
    /**
     * @param \Magento\Framework\App\Helper\Context $context
     */
    public function __construct(
        \Magento\Framework\App\Helper\Context $context,
        \Magento\Framework\Api\SearchCriteriaBuilder $searchCriteriaBuilder,
        \Magento\Eav\Api\AttributeRepositoryInterface $attributeRepository,
        \OrviSoft\AttributeGroups\Model\GroupsFactory $GroupsFactory,
        \OrviSoft\AttributeGroups\Model\AttributesFactory $AttributesFactory ,
        \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig
    ) {
        parent::__construct($context);
        $this->searchCriteriaBuilder = $searchCriteriaBuilder;
        $this->attributeRepository = $attributeRepository;
        $this->_attributesFactory = $AttributesFactory; 
        $this->_groupsFactory = $GroupsFactory;
        $this->scopeConfig = $scopeConfig;
    }

    function getStatus(){
        return $this->scopeConfig->getValue('attribute_groups/configuration/status', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
    }

    function getAttributes(){
        $searchCriteria = $this->searchCriteriaBuilder->create();
        $attributeRepository = $this->attributeRepository->getList(
            'catalog_product',
            $searchCriteria
        );
        $data = [];
        foreach ($attributeRepository->getItems() as $items) {
            $data[$items->getAttributeCode()] = $items->getFrontendLabel();
        }
        return $data;
    }
    
    public function getOptionArray3()
    {
        $data = $this->_groupsFactory->create()->getCollection();
        $output = [
            0 => 'Default'
        ];
        foreach($data as $value){
            $output[$value->getId()] = $value->getName();
        }
        return $output;
    }

    public function getValueArray3()
    {
        $data_array=array();
        foreach($this->getOptionArray3() as $k=>$v){
            $data_array[]=array('value'=>$k,'label'=>$v);
        }
        return($data_array);
    }
    
    public function getOptionArray5()
    {
        return $this->getAttributes();
    }
    
    public function getValueArray5()
    {
        $data_array=array();
        foreach($this->getOptionArray5() as $k=>$v){
            $data_array[]=array('value'=>$k,'label'=>$v);
        }
        return($data_array);
    }

    public function getAttributeGroup($groupID){
        if($this->getStatus() == false){
            return false;
        }
        $collection = $this->_attributesFactory->create()->getCollection()
                            ->addFieldToFilter('parent_id', array('eq' => (int)$groupID));
        $collection->getSelect()->order('sort_by ASC');
        if($collection->count() == 0){
            return false;
        }
        $output = [];
        foreach($collection as $value){
            $output[$value->getTitle()] = explode(',',$value->getAttributes());
        }
        return $output;
    }

    public function getAttributeHTML($groupID, $_product){
        $data = $this->getAttributeGroup($groupID);
        if($data == false){
            return false;
        }
        $output = '<div id="technical-specifications" class="technical-specifications">';

        foreach($data as $title => $value){
            $output .= '<div class="wrap-technical-specs">';
            $output .= '<h3 class="technical-specification attribute-group-title">'.__($title).'</h3>';
            foreach ($value as $attribute){
                $attribute_value = $_product->getResource()->getAttribute($attribute)->getFrontend()->getValue($_product);
                if(is_array($attribute_value)){
                    $attribute_value = implode(',', $attribute_value);
                }
                if(strlen($attribute_value) == 0){
                    continue 1;
                }
                $output .= '<div class="liner-specs">';
                $output .= '<div class="technical-specification attribute-label"><strong>'.$_product->getResource()->getAttribute($attribute)->getFrontend()->getLabel($_product).'</strong></div>';
                
                $output .= '<div class="technical-specification attribute-value">'.$attribute_value.'</div>';
                $output .= '</div>';
            }
            $output .= '</div>';
        }
        $output .= '</div>';
        return $output;
    }
}