<?php
/**
 * Created by PhpStorm.
 * User: liyassoladogun
 * Date: 11/21/18
 * Time: 4:25 PM
 */

namespace Training\S5v1\Model\Attribute\Backend;


use Magento\Eav\Model\Entity\Attribute\Backend\AbstractBackend;
use Magento\Framework\Exception\LocalizedException;

class VendorCode extends AbstractBackend
{

    public function validate($object)
    {
       if (!preg_match('/^[A-Z0-9]+$/', $object->getData($this->getAttribute()->getAttributeCode()))) {
           throw new LocalizedException(__("Vendor Code Doesnt Match Pattern"));
       }
    }
}