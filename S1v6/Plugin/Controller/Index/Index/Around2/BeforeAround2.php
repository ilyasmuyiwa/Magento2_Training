<?php
/**
 * Created by PhpStorm.
 * User: liyassoladogun
 * Date: 11/13/18
 * Time: 10:59 PM
 */

namespace Training\S1v6\Plugin\Controller\Index\Index\Around2;
use Training\S1v6\Plugin\BasePlugin;
use Magento\Framework\App\RequestInterface;
use Training\S1v6\Controller\Index\Index;
use Training\S1v6\Plugin\Controller\Index\Index\Around2;


class BeforeAround2 extends BasePlugin
{

    public function beforeAroundDispatch(
     Around2 $subject,
     Index $action,
      callable $proceed,
      RequestInterface $request,
      $test = 'Plugin BA2'
    )
    {
      $this->sayHello([$subject, $action, $proceed, $request, $test]);
    }
}