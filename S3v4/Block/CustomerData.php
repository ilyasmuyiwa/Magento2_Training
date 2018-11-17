<?php
/**
 * Created by PhpStorm.
 * User: liyassoladogun
 * Date: 11/17/18
 * Time: 12:16 PM
 */

namespace Training\S3v4\Block;


use Magento\Framework\View\Element\Template;
use Training\S3v4\Model\Customer\Membership\Source\Options;

class CustomerData extends Template
{
    protected $membershipOptions;

    public function __construct(Options $membershipOptions,
                                Template\Context $context, array $data = [])
    {
        $this->membershipOptions = $membershipOptions;
        parent::__construct($context, $data);
    }

    public function getMembershipOptions(){
        return $this->membershipOptions->getAllOptions();
    }

}