<?php
/**
 * Created by PhpStorm.
 * User: liyassoladogun
 * Date: 11/14/18
 * Time: 7:38 AM
 */

namespace Training\S1v10\Block;


use Magento\Framework\View\Element\Template;
use Training\S1v10\CacheableBlock\App\Cache\Type\Cblock;

class CustomBlock extends Template
{
  const CACHE_GROUP = Cblock::CACHE_TAG;
}