<?php
/**
 * Created by PhpStorm.
 * User: liyassoladogun
 * Date: 11/22/18
 * Time: 8:25 AM
 */

namespace Training\S5v3\Block;


use Magento\Framework\Registry;
use Magento\Framework\View\Element\Template;

class Promotion extends Template
{
    protected $registry;
    public function __construct(Registry $registry, Template\Context $context, array $data = [])
    {
        $this->registry = $registry;
        parent::__construct($context, $data);
    }

    public function getPromotionBanner(){
        $promotionBanner = $this->registry->registry('current_category')->getCustomAttribute('show_promotion_banner');
        if (!is_object($promotionBanner)) {
            return "No Bannner Found";
        }

        return $promotionBanner->getValue();
    }

}