<?php
namespace OrviSoft\AttributeGroups\Controller\Adminhtml\groups;
/**
 *
 *  @author:    Farhan Islam <farhan@orvisoft.com>
 *  @module:    OrviSoft Attribute Groups (https://github.com/askwhyweb/Attribute-Groups-Magento2)
 *
**/
use Magento\Backend\App\Action;

/**
 * Class MassDelete
 */
class MassDelete extends \Magento\Backend\App\Action
{
    /**
     * @return \Magento\Backend\Model\View\Result\Redirect
     */
    public function execute()
    {
        $itemIds = $this->getRequest()->getParam('groups');
        if (!is_array($itemIds) || empty($itemIds)) {
            $this->messageManager->addError(__('Please select item(s).'));
        } else {
            try {
                foreach ($itemIds as $itemId) {
                    $post = $this->_objectManager->get('OrviSoft\AttributeGroups\Model\Groups')->load($itemId);
                    $post->delete();
                }
                $this->messageManager->addSuccess(
                    __('A total of %1 record(s) have been deleted.', count($itemIds))
                );
            } catch (\Exception $e) {
                $this->messageManager->addError($e->getMessage());
            }
        }
        return $this->resultRedirectFactory->create()->setPath('attributegroups/*/index');
    }
}