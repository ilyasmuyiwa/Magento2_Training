<?php
/**
 * Created by PhpStorm.
 * User: liyassoladogun
 * Date: 11/17/18
 * Time: 11:23 AM
 */

namespace Training\S3v3\ViewModel\Storefront;


class Header implements \Magento\Framework\View\Element\Block\ArgumentInterface
{
    public function getHeader(){
        return 'StoreFront page Header';
    }
}