<?php
/**
 * Created by PhpStorm.
 * User: liyassoladogun
 * Date: 11/17/18
 * Time: 11:14 AM
 */

namespace Training\S3v3\Block;


use Magento\Framework\View\Element\Template;

/**
 * Class Page
 * @package Training\S3v3\Block
 */
class Page extends Template
{
    /**
     * @return mixed
     */
    public function getViewModel() {
        return $this->getData('viewModel');
    }

}