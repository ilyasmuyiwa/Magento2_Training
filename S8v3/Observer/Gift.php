<?php
/**
 * Created by PhpStorm.
 * User: liyassoladogun
 * Date: 11/29/18
 * Time: 2:40 PM
 */

namespace Training\S8v3\Observer;


use Magento\Catalog\Api\ProductRepositoryInterface;
use Magento\Catalog\Model\Product;
use Magento\CatalogRule\Test\Block\Adminhtml\Promo\Catalog;
use Magento\Framework\Event\ObserverInterface;
use \Magento\Quote\Model\Quote;
use MEQP2\Tests\NamingConventions\true\false;

class Gift implements ObserverInterface
{
    const GIFT_SKU = '24-WB02';
    const TARGET_SKU = '24-MB01';
    const DISCOUNT = 10;
    protected $request;

    protected $productRepository;

    public function __construct(
        ProductRepositoryInterface $productRepository,
        \Magento\Framework\App\RequestInterface $request

    )
    {
        $this->productRepository = $productRepository;
        $this->request = $request;
    }

    public function execute(\Magento\Framework\Event\Observer $observer)
    {
        /** @var Quote $quote */
      $quote = $observer->getEvent()->getQuote();

      $qualityForGift = 0;
      $giftItemId = 0;

          foreach ($quote->getAllItems() as $item) {

              if ($item->getSku() == self::TARGET_SKU) {
                  $qualityForGift = 1;
                  $test = 30;
                  continue;
              }



              if ($item->getSku() == self::GIFT_SKU) {
                  $giftItemId = $item->getId();
                  $giftItem = $item;
                  continue;
              }
          }
          if(!$giftItemId && $qualityForGift==1) {

                  $this->addGift($quote);
              } elseif ($giftItemId && $qualityForGift == 0) {
                  if ($giftItem->getOptionByCode('gift_product'))
                      $this->removeGift($quote, $giftItemId);
          }


    }

    protected function addGift(Quote $quote) {
        /** @var Product $giftProduct */
        $giftProduct = $this->productRepository->get(self::GIFT_SKU);
        $giftProduct->addCustomOption('gift_product', 1);
        $item = $quote->addProduct($giftProduct, 1);
        $price = $giftProduct->getFinalPrice() - self::DISCOUNT;
        $item->setCustomPrice($price);
        $item->setOriginalCustomPrice($price);


        try{
            $quote->save();
        } catch (\Exception $e) {
            $writer = new \Zend\Log\Writer\Stream(BP . '/var/log/ttlogfile.log');
            $logger = new \Zend\Log\Logger();
            $logger->addWriter($writer);
            $logger->info($e->getMessage());
        }

         return $this;
    }

    protected function removeGift(Quote $quote, $giftItemId) {
        $quote->removeItem($giftItemId);
        return $this;
    }

    protected function isTargetProduct($item) {
        if ($item->getSku() == self::TARGET_SKU) {
            return true;
        }
        return false;
    }

    protected function isGift($item) {
        if ($item->getSku() == self::GIFT_SKU) {
            return true;
        }
        return false;
    }
}