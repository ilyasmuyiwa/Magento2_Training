<?php
/**
 * Created by PhpStorm.
 * User: liyassoladogun
 * Date: 11/17/18
 * Time: 11:18 AM
 */

namespace Training\S3v3\ViewModel\Adminhtml;


class Header implements \Magento\Framework\View\Element\Block\ArgumentInterface
{
    public function getHeader(){
        return 'Adminhtml page Header';
    }

}