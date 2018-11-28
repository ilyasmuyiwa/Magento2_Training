<?php
/**
 * Created by PhpStorm.
 * User: liyassoladogun
 * Date: 11/27/18
 * Time: 10:34 PM
 */

namespace Training\S7v4\Plugin;


class Base
{
    public function aroundGet(\Magento\Framework\Pricing\Price\Collection $subject, \Closure $proceed, $price) {

        $writer = new \Zend\Log\Writer\Stream(BP . '/var/log/price_collection.log');
        $logger = new \Zend\Log\Logger();
        $logger->addWriter($writer);
        $logger->info($price);
       return $proceed($price);
    }

}