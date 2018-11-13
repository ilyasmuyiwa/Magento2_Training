<?php
/**
 * Created by PhpStorm.
 * User: liyassoladogun
 * Date: 11/12/18
 * Time: 9:26 PM
 */

namespace Training\S1v1\Plugin;


use Training\S1v1\Framework\Logger\Logger;

class Carrier
{
    /**
     * @var Logger
     */
    private $logger;

    public function __construct(Logger $logger)
    {
        $this->logger = $logger;
    }

    /**
     * @param $subject
     * @param \Magento\Framework\DataObject $request
     */
    function beforeSetRequest($subject, \Magento\Framework\DataObject $request) {
        $data = $request->getData();
        $this->logger->info('DHL Set Carrer Working', $data);
    }

}