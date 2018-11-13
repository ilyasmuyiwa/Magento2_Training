<?php
/**
 * Created by PhpStorm.
 * User: liyassoladogun
 * Date: 11/13/18
 * Time: 10:32 PM
 */

namespace Training\S1v6\Plugin;


use Psr\Log\LoggerInterface;

class BasePlugin
{

    private $logger;

    public function __construct(
        LoggerInterface $logger
    )
    {
        $this->logger = $logger;
    }

    public function sayHello(array $context, $aroundPluginSuffix = '') {
      $pluginName = (new \ReflectionClass($this))->getShortName();
      $message = $pluginName . 'plugin say hello' . $aroundPluginSuffix;
      $this->logger->info($message, $context);
    }

}