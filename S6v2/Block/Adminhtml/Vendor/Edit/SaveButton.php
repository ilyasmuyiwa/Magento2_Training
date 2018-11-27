<?php
/**
 * Created by PhpStorm.
 * User: liyassoladogun
 * Date: 11/24/18
 * Time: 10:50 PM
 */

namespace Training\S6v2\Block\Adminhtml\Vendor\Edit;


use Magento\Framework\View\Element\UiComponent\Control\ButtonProviderInterface;

/**
 * Class SaveButton
 */
class SaveButton extends GenericButton implements ButtonProviderInterface
{
    /**
     * @return array
     */
    public function getButtonData()
    {
        return [
            'label' => __('Save Vendor'),
            'class' => 'save primary',
            'data_attribute' => [
                'mage-init' => ['button' => ['event' => 'save']],
                'form-role' => 'save',
            ],
            'sort_order' => 90,
        ];
    }
}

