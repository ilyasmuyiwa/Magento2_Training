<?php
/**
 * Created by PhpStorm.
 * User: liyassoladogun
 * Date: 11/17/18
 * Time: 12:07 PM
 */

namespace Training\S3v4\CustomerData;


use Magento\Customer\CustomerData\Customer;

class CustomerMembership extends Customer
{

    public function getSectionData()
    {
        $data = parent::getSectionData();

        if(!empty($data)){
            $data['membership'] = '2';

        }

        return $data;
    }
}