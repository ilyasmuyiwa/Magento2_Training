<?php
/**
 * Created by PhpStorm.
 * User: liyassoladogun
 * Date: 11/25/18
 * Time: 10:41 AM
 */

namespace Training\S6v2\Controller\Adminhtml\Grid;


use Magento\Backend\App\Action;

class Delete extends Action
{
    protected $_model;

    /**
     * @param Action\Context $context
     * @param \Itcolony\SeoOverwrite\Model\Update $model
     */
    public function __construct(
        Action\Context $context,
        \Training\S4v1\Model\Vendor $model
    ) {
        parent::__construct($context);
        $this->_model = $model;
    }

    /**
     * {@inheritdoc}
     */
    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('Training_S6v2::catalog_vendor_edit');
    }

    /**
     * Delete action
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        $id = $this->getRequest()->getParam('id');
        /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();
        if ($id) {
            try {
                $model = $this->_model;
                $model->load($id);
                $model->delete();
                $this->messageManager->addSuccess(__('Vendor deleted'));
                return $resultRedirect->setPath('*/*/');
            } catch (\Exception $e) {
                $this->messageManager->addError($e->getMessage());
                return $resultRedirect->setPath('*/*/edit', ['id' => $id]);
            }
        }
        $this->messageManager->addError(__('Vendor does not exist'));
        return $resultRedirect->setPath('*/*/');
    }
}
