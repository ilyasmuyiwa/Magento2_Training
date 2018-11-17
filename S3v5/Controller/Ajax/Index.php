<?php
/**
 * Created by PhpStorm.
 * User: liyassoladogun
 * Date: 11/17/18
 * Time: 2:09 PM
 */

namespace Training\S3v5\Controller\Ajax;

use Magento\ConfigurableProduct\Model\Product\Type\Configurable;
use Magento\Catalog\Model\ProductRepository;
use Magento\Catalog\Model\Product;
use Magento\Framework\Controller\Result\Json;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;

class Index extends Action
{
    protected $resultJson;

    protected  $productRepository;

    protected $configurable;

    public function __construct(Context $context,
                   Json $resultJson,
                   ProductRepository $productRepository,
                  Configurable $configurable)
   {
       $this->resultJson = $resultJson;
       $this->productRepository = $productRepository;
       $this->configurable = $configurable;
       parent::__construct($context);
   }

    public function execute()
   {

       if($this->getRequest()->isAjax()) {
           $productId = $this->getRequest()->getParam('product_id');

           $superAttr =  $this->getRequest()->getParam('super_attribute');
           $product = $this->productRepository->getById($productId);
           /** @var Configurable $productType */
           //$productType = $product->getTypeInstace();
           $simpleProduct = $this->configurable->getProductByAttributes($superAttr, $product);

           $jsonData = [
               'id' => $simpleProduct->getId(),
               'description' => $simpleProduct->getDescription()
           ];

           return $this->resultJson->setData($jsonData);
       }

   }
}