<?php
/**
 * Created by PhpStorm.
 * User: liyassoladogun
 * Date: 11/14/18
 * Time: 7:41 AM
 */

namespace Training\S1v10\Controller\Index;


use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\App\Action\Redirect;
use Magento\Framework\App\CacheInterface;
use Magento\Framework\Controller\Result\Forward;
use Magento\Framework\View\Result\PageFactory;
use Training\S1v10\CacheableBlock\App\Cache\Type\Cblock;

class Clean extends Action
{
    protected $resultPageFactory;
    private  $cache;
    private $block;
    private $forward;

    public function __construct(Context $context,
                                Forward $forward,
                                CacheInterface $cache
    )
    {
        $this->forward = $forward;
        $this->cache = $cache;
        parent::__construct($context);
    }

    public function execute()
    {
        $this->cache->clean([Cblock::CACHE_TAG]);
        return $this->forward->forward('index');
    }
}

