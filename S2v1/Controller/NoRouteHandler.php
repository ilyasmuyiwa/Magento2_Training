<?php
/**
 * Created by PhpStorm.
 * User: liyassoladogun
 * Date: 11/14/18
 * Time: 3:52 PM
 */

namespace Training\S2v1\Controller;


use Magento\Framework\App\Router\NoRouteHandlerInterface;

class NoRouteHandler implements NoRouteHandlerInterface
{

    public function process(\Magento\Framework\App\RequestInterface $request)
    {
        $fullActionName = $request->getFullActionName();
        $writer = new \Zend\Log\Writer\Stream(BP . '/var/log/test.log');
        $logger = new \Zend\Log\Logger();
        $logger->addWriter($writer);
        $logger->info($fullActionName);
        if ($fullActionName=='catalog_product_noroute') {
            $request->setRouteName('noroute')
                     ->setControllerName('noroute')
                    ->setActionName('index');
            return true;
        }

        return false;
    }

}