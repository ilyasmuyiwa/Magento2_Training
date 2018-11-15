<?php
/**
 * Created by PhpStorm.
 * User: liyassoladogun
 * Date: 11/15/18
 * Time: 9:25 PM
 */

namespace Training\S2v4\Logger\Handler\Base;


use Magento\Framework\Logger\Handler\Base;

class Log extends Base
{

    protected $fileName = '/var/log/action_data.log';

    protected $loggerType = \Monolog\Logger::DEBUG;
}