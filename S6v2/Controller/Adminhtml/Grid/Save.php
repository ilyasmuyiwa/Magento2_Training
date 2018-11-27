<?php
/**
 * Created by PhpStorm.
 * User: liyassoladogun
 * Date: 11/25/18
 * Time: 7:44 AM
 */

namespace Training\S6v2\Controller\Adminhtml\Grid;


use Magento\Backend\App\Action;

class Save extends Action
{

    protected $_model;


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
     * Save action
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {

        $data = $this->getRequest()->getPostValue();
        /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();
        if ($data) {
            $model = $this->_model;
            $id = $this->getRequest()->getParam('vendor_id');
            if ($id) {
                $model->load($id);
            }

            $model->setData($data['vendor']);

            $this->_eventManager->dispatch(
                'vendor_prepare_save',
                ['vendor' => $model, 'request' => $this->getRequest()]
            );

            try {
                $model->save();
                $this->messageManager->addSuccess(__('Vendor Data saved'));
                $this->_getSession()->setFormData(false);
                if ($this->getRequest()->getParam('back')) {
                    return $resultRedirect->setPath('*/*/edit', ['id' => $model->getId(), '_current' => true]);
                }
                return $resultRedirect->setPath('*/*/index');
            } catch (\Magento\Framework\Exception\LocalizedException $e) {
                $this->messageManager->addError($e->getMessage());
            } catch (\RuntimeException $e) {
                $this->messageManager->addError($e->getMessage());
            } catch (\Exception $e) {
                $this->messageManager->addError( __($e->getMessage()));
            }

            $this->_getSession()->setFormData($data);
            return $resultRedirect->setPath('*/*/edit', ['entity_id' => $this->getRequest()->getParam('id')]);
        }
        return $resultRedirect->setPath('*/*/index');
    }
}
