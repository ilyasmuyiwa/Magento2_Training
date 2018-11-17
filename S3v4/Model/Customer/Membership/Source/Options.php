<?php
/**
 * Created by PhpStorm.
 * User: liyassoladogun
 * Date: 11/17/18
 * Time: 12:11 PM
 */

namespace Training\S3v4\Model\Customer\Membership\Source;


use Magento\Eav\Model\Entity\Attribute\Source\AbstractSource;

class Options extends AbstractSource
{

    const MEMBERSHIP_TYPE = [
        1 => 'regular',
        2 => 'gold'
    ];

    public function getAllOptions()
    {
        if ($this->_options == null) {
            foreach (self::MEMBERSHIP_TYPE as $value => $label) {
                $this->_options[] =[
                    'label' => __($label),
                    'value' => $value
                ];
            }

            return $this->_options;
        }
    }
}