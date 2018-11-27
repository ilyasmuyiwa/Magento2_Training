<?php
/**
 * Created by PhpStorm.
 * User: liyassoladogun
 * Date: 11/25/18
 * Time: 12:12 AM
 */

namespace Training\S6v2\Controller\Adminhtml\Grid;

use Magento\Backend\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;
use Magento\Backend\App\Action;

class Index extends Action
{

    /**
     * @var PageFactory
     */
    protected $resultPageFactory;

    /**
     * @param Context $context
     * @param PageFactory $resultPageFactory
     */
    public function __construct(
        Context $context,
        PageFactory $resultPageFactory
    ) {
        parent::__construct($context);
        $this->resultPageFactory = $resultPageFactory;
    }

    /**
     * Index action
     *
     * @return \Magento\Backend\Model\View\Result\Page
     */
    public function execute()
    {
        /** @var \Magento\Backend\Model\View\Result\Page $resultPage */
        $resultPage = $this->resultPageFactory->create();
        $resultPage->setActiveMenu('Training_S6v2::catalog_vendors');
        $resultPage->addBreadcrumb(__('Vendor'), __('Vendor'));
        $resultPage->addBreadcrumb(__('Manage Seo Data'), __('Manage Seo Data'));
        $resultPage->getConfig()->getTitle()->prepend(__('Vendor Data'));

        return $resultPage;
    }
}
