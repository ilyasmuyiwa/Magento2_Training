<?php
namespace Training\S1v2\Controller\Index;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;
use Training\S1v2\Model\Sample\DataFactory;

class Sample extends Action
{
    /**
     * @var PageFactory
     */
    private $resultPageFactory;

    /** @var  DataFactory $dataReader */
    private $dataReader;

    /**
     * @param Context $context
     * @param PageFactory $resultPageFactory
     * @param DataFactory $dataReader
     */
    public function __construct(
        Context $context,
        PageFactory $resultPageFactory,
        DataFactory $dataReader
    )
    {
        $this->dataReader = $dataReader;
        parent::__construct($context);
    }

    /**
     * Renders Sample
     */
    public function execute()
    {
        $myConfig = $this->dataReader->create();
        print_r($myConfig->get());
    }
}