<?php
/**
 * Created by PhpStorm.
 * User: liyassoladogun
 * Date: 11/23/18
 * Time: 1:25 PM
 */

namespace Training\S6v3\Plugin\User;


use Magento\Framework\Exception\AuthenticationException;
use Magento\User\Model\User;
use Training\S6v1\Model\User\Auth\IpAuth;

class VerifyIdentity
{
    protected $ipAuth;

    public function __construct(IpAuth $ipAuth)
    {
        $this->ipAuth = $ipAuth;
    }

    public function aroundVerifyIdentity(User $subject, \Closure $proceed, $password) {
        $result = false;
        if($this->ipAuth->verifyIdentity()) {
            if ($subject->getIsActive() != '1') {
                throw new AuthenticationException(
                    __('Custom You did not sign in correctly or your account is temporarily disabled.')
                );
            }
            if (!$subject->hasAssigned2Role($subject->getId())) {
                throw new AuthenticationException(__('Custom You need more permissions to access this.'));
            }
            $result = true;
        }

        return $result;

    }

}