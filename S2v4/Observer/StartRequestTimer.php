<?php
/**
 * Created by PhpStorm.
 * User: liyassoladogun
 * Date: 11/15/18
 * Time: 9:39 PM
 */

namespace Training\S2v4\Observer;


use Magento\Framework\Event\ObserverInterface;
use Training\S2v4\Model\RequestTimer;

class StartRequestTimer implements ObserverInterface
{
    private $requestTimer;

    public function __construct(RequestTimer $requestTimer)
    {
        $this->requestTimer = $requestTimer;
    }

    public function execute(\Magento\Framework\Event\Observer $observer)
    {
       $this->requestTimer->startTimer();
    }
}