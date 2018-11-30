<?php
/**
 * Created by PhpStorm.
 * User: liyassoladogun
 * Date: 11/30/18
 * Time: 11:33 PM
 */

namespace Training\S8v4\Plugin;
use \Magento\Quote\Model\Quote\Item\ToOrderItem as QuoteToOrderItem;
use Magento\Sales\Api\Data\OrderItemInterface;


class CommentOrder
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
        $additionalOptions = $item->getProductOptionByCode('additional_options');

        if (count($additionalOptions) > 0) {
            $options = $orderItem->getProductOption();
            $options['additional_options'] = unserialize($lottery->getValue());
            $orderItem->setProductOption($options);
        }

        return $orderItem;


    }
}