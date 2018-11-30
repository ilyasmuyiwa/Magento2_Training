<?php
/**
 * Created by PhpStorm.
 * User: liyassoladogun
 * Date: 11/30/18
 * Time: 11:31 PM
 */

namespace Training\S8v4\Observer;


use Magento\Framework\Event\ObserverInterface;
use Magento\Quote\Model\Quote;

class CartUpdate implements ObserverInterface
{
    public function execute(\Magento\Framework\Event\Observer $observer)
    {
        /** @var Quote $quote */
      $quote = $observer->getEvent()->getCart()->getQuote();
      $info = $observer->getEvent()->getInfo();

      foreach ($quote->getItems() as $item) {
          $additionalOptions = [];
          $additionalOptions[] = [
              'label' => 'comment',
              'value' => $info[$item->getId()]['comment']
          ];

          $item->addOption([
              'code' => 'additional_options',
               'value' => serialize($additionalOptions),
               'product_id' => $item->getProductId()
              ]
          );

          $item->saveItemOptions();
      }
    }

}