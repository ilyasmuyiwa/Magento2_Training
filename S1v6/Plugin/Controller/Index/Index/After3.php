<?php
/**
 * Created by PhpStorm.
 * User: liyassoladogun
 * Date: 11/13/18
 * Time: 10:30 PM
 */

namespace Training\S1v6\Plugin\Controller\Index\Index;


use Magento\Framework\App\RequestInterface;
use Magento\Framework\Controller\ResultInterface;
use Training\S1v6\Controller\Index\Index;
use Training\S1v6\Plugin\BasePlugin;

class After3 extends BasePlugin
{

    public function afterDispatch(Index $action, ResultInterface $result, RequestInterface $request, $test) {
        $this->sayHello([$action, $result, $request, $test]);
        return $result;
    }

}