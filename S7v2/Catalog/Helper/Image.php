<?php
/**
 * Created by PhpStorm.
 * User: liyassoladogun
 * Date: 11/26/18
 * Time: 10:58 AM
 */

namespace Training\S7v2\Catalog\Helper;


use Magento\Catalog\Model\View\Asset\ImageFactory;

class Image extends \Magento\Catalog\Helper\Image
{
    protected $imageFactory;

    public function __construct(\Magento\Framework\App\Helper\Context $context,
                                \Magento\Catalog\Model\Product\ImageFactory $productImageFactory,
                                \Magento\Framework\View\Asset\Repository $assetRepo,
                                \Magento\Framework\View\ConfigInterface $viewConfig,
                                ImageFactory $imageFactory)
    {
        $this->imageFactory = $imageFactory;
        parent::__construct($context, $productImageFactory, $assetRepo, $viewConfig);
    }

    public function  getUrl()
    {
       try{
          return $this->getDefaultUrl();
       } catch (\Exception $e) {
           return $this->getDefaultPlaceholderUrl();
       }
    }

    public function getDefaultUrl() {
       try{
           $imageAsset = $this->imageFactory->create(['filePath' =>'']);
           $url = $imageAsset->getContext()->getBaseUrl().$this->_imageFile;
       } catch (\Exception $e) {
          $url = $this->_urlBuilder->getUrl('', ['_direct' => 'core/index/notFound']);
       }
       return $url;
    }

}