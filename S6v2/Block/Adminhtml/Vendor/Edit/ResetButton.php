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
 * Class ResetButton
 */
class ResetButton implements ButtonProviderInterface
{
    /**
     * @return array
     */
    public function getButtonData()
    {
        return [
            'label' => __('Reset'),
            'class' => 'reset',
            'on_click' => 'location.reload();',
            'sort_order' => 30
        ];
    }
}
