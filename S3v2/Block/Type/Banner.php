<?php
/**
 * Created by PhpStorm.
 * User: liyassoladogun
 * Date: 11/16/18
 * Time: 8:30 PM
 */

namespace Training\S3v2\Block\Type;


use Magento\Framework\Module\Dir\Reader;
use Magento\Framework\View\Asset\Repository;
use Magento\Framework\View\FileSystem;
use Magento\Framework\View\Page\Config;
use Magento\Framework\View\Element\Template;

class Banner extends Template
{

    const CACHE_GROUP = \Training\S3v2\App\Cache\Type\Banner::TYPE_IDENTIFIER;

    const TEMPLATE_FILE_PATH = 'banners';

    protected $dirReader;

   public function __construct(Template\Context $context, $data , Reader $reader, Config $pageConfig)
   {
       $this->dirReader = $reader;
       $this->pageConfig = $pageConfig;
       parent::__construct($context, $data);
   }

   protected function _prepareLayout()
   {
       $this->pageConfig->setPageLayout('2columns-right');

   }

   public function getTemplateFile($template = null)
   {
     if(!$template) {
         $template = $this->getTemplate();
         list($module, $fileName) = Repository::extractModule(
             FileSystem::normalizePath($template)
         );
     }

     $pathchunks = [
         'module_view' => $this->dirReader->getModuleDir('view', $module)
     ];

     $area = $this->getArea();
       $pathchunks['area'] = $area;
       $pathchunks['tmpl_dir'] = self::TEMPLATE_FILE_PATH;

     $pathchuncks['file'] = $fileName;

     $file = implode(DIRECTORY_SEPARATOR, $pathchunks);
     $file .= DIRECTORY_SEPARATOR.$fileName;

     return $file;
   }

   public function fetchView($fileName)
   {
     $html = '';
     if(file_exists($fileName) && is_readable($fileName)) {
         $html = $this->render($fileName);
     }

     return $html;
   }

   public function render($fileName) {
       $html = file_get_contents($fileName);

       return $html;
   }


}