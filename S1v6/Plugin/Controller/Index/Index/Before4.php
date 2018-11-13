<?php
/**
 * Created by PhpStorm.
 * User: liyassoladogun
 * Date: 11/13/18
 * Time: 10:30 PM
 */

namespace Training\S1v6\Plugin\Controller\Index\Index;


use Magento\Framework\App\RequestInterface;
use Training\S1v6\Controller\Index\Index;
use Training\S1v6\Plugin\BasePlugin;

class Before4 extends BasePlugin
{

    public function beforeDispatch(Index $action, RequestInterface $request, $test = 'plugin B4') {
        $this->sayHello([$action, $request, $test]);
    }

}