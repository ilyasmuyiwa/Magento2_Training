<?php
/**
 * Created by PhpStorm.
 * User: liyassoladogun
 * Date: 11/20/18
 * Time: 1:31 PM
 */

namespace Training\S4v1\Plugin;

use Training\S4v1\Api\Data\VendorExtensionFactory;
use Training\S4v1\Api\Data\VendorInterface;
use Training\S4v1\Model\VendorRepository;

class CustomMessage
{
    protected $extensionFactory;

    public function __construct(VendorExtensionFactory $vendorExtensionFactory)
    {
        $this->extensionFactory = $vendorExtensionFactory;
    }

    public function aroundGetById(VendorRepository $subject, \Closure $proceed, $vendorId) {
        /** @var VendorInterface $get */
        $get = $proceed($vendorId);
        $extensionAttributes = $get->getExtensionAttributes();
        if ($extensionAttributes === null) {
            $extensionAttributes = $this->extensionFactory->create();
        }
        $extensionAttributes->setCustomExtensionAttributes('I am happy its working'.' '.$get->getVendorName());
        $get->setExtensionAttributes($extensionAttributes);


        return $get;

    }
}