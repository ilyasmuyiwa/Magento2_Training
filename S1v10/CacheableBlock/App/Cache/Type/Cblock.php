<?php
/**
 * Created by PhpStorm.
 * User: liyassoladogun
 * Date: 11/14/18
 * Time: 7:24 AM
 */

namespace Training\S1v10\CacheableBlock\App\Cache\Type;

use Magento\Framework\Cache\Frontend\Decorator\TagScope;
use Magento\Framework\Config\CacheInterface;


class Cblock extends TagScope implements CacheInterface
{
    const TYPE_IDENTIFIER = 'cblock';
    const CACHE_TAG = 'CBLOCK';

    public function __construct(\Magento\Framework\App\Cache\Type\FrontendPool $cacheFrontendPool)
    {
        parent::__construct($cacheFrontendPool->get(self::TYPE_IDENTIFIER), self::CACHE_TAG);
    }

}