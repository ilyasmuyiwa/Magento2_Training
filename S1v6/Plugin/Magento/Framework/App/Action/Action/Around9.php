<?php
/**
 * Created by PhpStorm.
 * User: liyassoladogun
 * Date: 11/13/18
 * Time: 10:30 PM
 */

namespace Training\S1v6\Plugin\Magento\Framework\App\Action\Action;


use Magento\Framework\App\RequestInterface;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\App\Action\Action as Index;
use Training\S1v6\Plugin\BasePlugin;

class Around9 extends BasePlugin
{

    public function aroundDispatch(Index $action, callable $proceed, RequestInterface $request, $test = 'plugin A9') {
        /* Before Path */
        $this->sayHello([$action, $proceed, $test], 'its before path');

        $returnValue = $proceed($request, $test);

        /* After Path */
        $this->sayHello([$action, $proceed, $test], 'its after path');


    }

}