<?php
/**
 * Created by PhpStorm.
 * User: liyassoladogun
 * Date: 11/14/18
 * Time: 7:41 AM
 */

namespace Training\S1v10\Controller\Index;


use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;

class Index extends Action
{
  protected $resultPageFactory;


  public function __construct(Context $context,
                            PageFactory $resultPageFactory
                            )
  {

      $this->resultPageFactory = $resultPageFactory;
      parent::__construct($context);
  }

  public function execute()
  {
      return $this->resultPageFactory->create();
  }
}

