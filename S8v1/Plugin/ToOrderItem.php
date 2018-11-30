<?php
/**
 * Created by PhpStorm.
 * User: liyassoladogun
 * Date: 11/28/18
 * Time: 9:39 PM
 */

namespace Training\S8v1\Plugin;

use \Magento\Quote\Model\Quote\Item\ToOrderItem as QuoteToOrderItem;
use Magento\Sales\Api\Data\OrderItemInterface;


class ToOrderItem
{

    public function aroundConvert(
        QuoteToOrderItem $subject,
        \Closure $proceed,
        $item,
        $data = []
    ) {
        /** @var OrderItemInterface $orderItem */
        $orderItem = $proceed($item, $data);
        /** @var array $lottery */
        $lottery = $item->getProductOptionByCode('additional_options');

        if (count($lottery) > 0) {
            $options = $orderItem->getProductOption();
            $options['additional_options'] = unserialize($lottery->getValue());
            $orderItem->setProductOption($options);
        }
        return $orderItem;

    }
}