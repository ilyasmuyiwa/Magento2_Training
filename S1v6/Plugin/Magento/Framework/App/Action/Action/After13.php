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

class After13 extends BasePlugin
{

    public function afterDispatch(Index $action, $result) {
        $this->sayHello([$action, $result]);
        return $result;
    }

}