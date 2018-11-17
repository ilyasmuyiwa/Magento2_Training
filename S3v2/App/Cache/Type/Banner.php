<?php
/**
 * Created by PhpStorm.
 * User: liyassoladogun
 * Date: 11/16/18
 * Time: 1:16 PM
 */

namespace Training\S3v2\App\Cache\Type;


use Magento\Framework\Cache\Frontend\Decorator\TagScope;
use Magento\Framework\Config\CacheInterface;

class Banner extends TagScope implements CacheInterface
{

    const TYPE_IDENTIFIER = 'banner';

    const CACHE_TAG = 'BANNER';

    public function __construct(\Magento\Framework\App\Cache\Type\FrontendPool $cacheFrontendPool)
    {
        parent::__construct($cacheFrontendPool->get(self::TYPE_IDENTIFIER), self::CACHE_TAG);
    }

}