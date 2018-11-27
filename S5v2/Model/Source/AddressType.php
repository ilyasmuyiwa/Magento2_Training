<?php
/**
 * Created by PhpStorm.
 * User: liyassoladogun
 * Date: 11/21/18
 * Time: 5:15 PM
 */

namespace Training\S5v2\Model\Source;


use Magento\Eav\Model\Entity\Attribute\Source\AbstractSource;

class AddressType extends AbstractSource
{

    /**
     * @return array
     */
    public function getAllOptions()
    {
        $this->_options = [
            ['label' => __('Home'), 'value' => 'Home'],
            ['label' => __('Work'), 'value' => 'Work'],
            ['label' => __('Other'), 'value' => 'Other']
        ];

        return $this->_options;
    }

}