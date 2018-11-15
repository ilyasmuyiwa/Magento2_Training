<?php
/**
 * Created by PhpStorm.
 * User: liyassoladogun
 * Date: 11/15/18
 * Time: 9:23 PM
 */

namespace Training\S2v4\Observer;


use Magento\Framework\Event\ObserverInterface;
use Magento\Framework\View\LayoutInterface;
use Psr\Log\LoggerInterface;
use Training\S2v4\Model\RequestTimer;

class LogActionData implements ObserverInterface
{
    private $loggger;
    private $layout;
   private $requestTimer;

    public function __construct(
        LoggerInterface $logger,
        LayoutInterface $layout,
        RequestTimer $requestTimer)
    {
        $this->loggger = $logger;
        $this->layout = $layout;
        $this->requestTimer = $requestTimer;
    }

    public function execute(\Magento\Framework\Event\Observer $observer)
    {
      $response = $observer->getEvent()->getData('response');
      $request = $observer->getEvent()->getData('request');

      $data = [];
      $data['full_action_name'] = $request->getFullActionName();
      $data['handles'] = $this->layout->getUpdate()->getHandles();

      foreach ($this->layout->getAllBlocks() as $block) {
          $data['blocks'][$block->getNameInLayout()] = $block->getData('type');
      }

      $sizeInKb = mb_strlen($response->getContent()) / 1024;

      $data['response_size'] = sprintf('%s kb', number_format($sizeInKb));

      $data['response_time'] = $this->requestTimer->getTimer();

      $this->loggger->debug(print_r($data, true));
    }

}