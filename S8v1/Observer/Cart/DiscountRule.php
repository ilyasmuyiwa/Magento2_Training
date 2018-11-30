<?php
/**
 * Created by PhpStorm.
 * User: liyassoladogun
 * Date: 11/28/18
 * Time: 8:08 PM
 */

namespace Training\S8v1\Observer\Cart;


use Magento\Framework\App\RequestInterface;
use Magento\Framework\Event\ObserverInterface;
use Magento\SalesRule\Model\Rule;
use Magento\SalesRule\Model\RuleFactory;
use Magento\Checkout\Model\Session;


class DiscountRule implements ObserverInterface
{

    protected $ruleFactory;

    protected $checkoutSession;

    const NAME = "Custom Program Discount";

    protected $conditions = [
        'type' => \Magento\SalesRule\Model\Rule\Condition\Combine::class,
        'attribute' => NULL,
        'operator' => NULL,
        'value' => '1',
        'is_value_processed' => NULL,
        'aggregator' => 'all',
        'conditions' => [ 0 =>
          [
              'type' => \Magento\SalesRule\Model\Rule\Condition\Product\Found::class,
              'attribute' => NULL,
              'operator' => NULL,
              'value' => '1',
              'is_value_processed' => NULL,
              'aggregator' => 'all',
              'conditions' => [ 0 => [

                  'type' => \Magento\SalesRule\Model\Rule\Condition\Product::class,
                  'attribute' => 'SKU',
                  'operator' => '==',
                  'value' => '24-MB02',
                  'is_value_processed' => NULL,
                  'aggregator' => false,
              ],
           ],
          ],
        ],
    ];

    protected $actions = [
        'type' => \Magento\SalesRule\Model\Rule\Condition\Combine::class,
        'attribute' => NULL,
        'operator' => NULL,
        'value' => '1',
        'is_value_processed' => NULL,
        'aggregator' => 'all'
    ];

    public function __construct(
       RuleFactory $ruleFactory,
       Session $session
    )
    {
        $this->ruleFactory = $ruleFactory;
        $this->checkoutSession = $session;
    }

    public function execute(\Magento\Framework\Event\Observer $observer)
    {
       $cartViewData['win_number'] = rand(1, 10);
       $this->checkoutSession->setStepData('win_number', $cartViewData);
        //$item2 = $observer->getProduct()->getCustomOptions()['additional_options']->getItem();
       $item = $this->checkoutSession->getQuote()->getItemByProduct($observer->getProduct());

       $additionalOption = unserialize($item->getOptionByCode('additional_options')->getValue());

       $value = array_shift($additionalOption);

       if ($cartViewData['win_number'] == $value['value'][0]) {
           /** @var Rule $model */
           $model = $this->ruleFactory->create();
           $fromDate = new \DateTime(date("m/d/Y"));
           $this->conditions['conditions'][0]['conditions'][0]['value'] = $observer->getProduct()->getSku();

           $model->setName(self::NAME)
               ->setDescription(self::NAME)
               ->setFromDate($fromDate->format(\DateTime::ISO8601))
               ->setToDate(null)
               ->setUsesPerCustomer(1)
               ->setIsActive(1)
               ->setStopRulesProcessing(0)
               ->setIsAdvanced(1)
               ->setProductIds(null)
               ->setSortOrder(1)
               ->setSimpleAction('by_percent')
               ->setDiscountAmount(10)
               ->setDiscountQty(0)
               ->setDiscountStep(0)
               ->setApplyToShipping(0)
               ->setTimesUsed(1)
               ->setIsRss(0)
               ->setCouponType(1)
               ->setUseAutoGeneration(0)
               ->setUsesPerCoupon(1)
               ->setCustomerGroupIds(0)
               ->setWebsiteIds(1)
               ->setCouponCode(null)
               ->setConditionsSerialized(serialize($this->conditions))
               ->setActionsSerialized(serialize($this->actions));

           $model->setData($model->getData());
           $model->loadPost($model->getData());
           $model->save();


       }
    }

}