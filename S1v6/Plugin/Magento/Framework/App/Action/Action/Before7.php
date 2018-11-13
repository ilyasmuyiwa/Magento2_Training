<?php
/**
 * Created by PhpStorm.
 * User: liyassoladogun
 * Date: 11/13/18
 * Time: 10:30 PM
 */

namespace Training\S1v6\Plugin\Magento\Framework\App\Action\Action;

use Magento\Framework\App\RequestInterface;
use Training\S1v6\Plugin\BasePlugin;
use Magento\Framework\App\Action\Action as Index;
class Before7 extends BasePlugin
{

    public function beforeDispatch(Index $action, RequestInterface $request, $test = 'plugin B7') {
        $this->sayHello([$action, $request, $test]);
    }

}