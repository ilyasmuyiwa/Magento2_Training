<?php
/**
 * Created by PhpStorm.
 * User: liyassoladogun
 * Date: 11/23/18
 * Time: 8:58 PM
 */

namespace Training\S6v4\Model\Attribute\VendorCode;


use Magento\Backend\Model\Auth\Session;
use Magento\Eav\Model\Entity\Attribute\Backend\AbstractBackend;
use Magento\Eav\Model\Entity\Attribute\Exception;
use Magento\Eav\Model\Entity\Attribute\Frontend\AbstractFrontend;


class Backend extends AbstractBackend
{
    const ADMIN_ACL = 'Training_S6v4::vendor_code_attr';

    private $authSession;

    public function __construct(Session $session)
    {
        $this->authSession = $session;
    }

    public function beforeSave($object)
    {
       if($this->authSession->isAllowed(self::ADMIN_ACL)) {
           $attrCode = $this->getAttribute()->getAttributeCode();
           if(!$object->hasData($attrCode) && $this->getDefaultValue()) {
               $object->setData($attrCode, $this->getDefaultValue());
           }
       } else {
           throw new \Exception("Cannot save resources");
       }
       return $this;
    }

}