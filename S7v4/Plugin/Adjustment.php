<?php
/**
 * Created by PhpStorm.
 * User: liyassoladogun
 * Date: 11/27/18
 * Time: 10:35 PM
 */

namespace Training\S7v4\Plugin;


class Adjustment
{

    public function beforeCreate(\Magento\Framework\Pricing\Amount\AmountFactory $subject, $amount, $adjustmentAmount) {

        $writer = new \Zend\Log\Writer\Stream(BP . '/var/log/adjustment.log');
        $logger = new \Zend\Log\Logger();
        $logger->addWriter($writer);
        $logger->info(print_r($adjustmentAmount, true));
    }
}