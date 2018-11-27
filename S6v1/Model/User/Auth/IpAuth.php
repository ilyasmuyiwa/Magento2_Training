<?php
/**
 * Created by PhpStorm.
 * User: liyassoladogun
 * Date: 11/23/18
 * Time: 1:36 PM
 */

namespace Training\S6v1\Model\User\Auth;


use Magento\Framework\DataObject;
use Magento\Framework\HTTP\PhpEnvironment\RemoteAddress;

class IpAuth extends DataObject
{

    const ALLOWED_IP = [
        '127.0.0.1'
    ];

    protected $remoteAddress;

    public function __construct(RemoteAddress $remoteAddress,array $data = [])
    {
        $this->remoteAddress = $remoteAddress;
        parent::__construct($data);
    }

    public function verifyIdentity(){
        return $this->isUserIpWhiteListed();
    }

    private function isUserIpWhiteListed(){
        return in_array($this->remoteAddress->getRemoteAddress(), self::ALLOWED_IP);
    }
}