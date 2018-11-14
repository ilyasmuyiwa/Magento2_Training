<?php
/**
 * Created by PhpStorm.
 * User: liyassoladogun
 * Date: 11/12/18
 * Time: 9:43 PM
 */

namespace Training\S1v1\Framework\Logger\Handler;
use Magento\Framework\Filesystem\DriverInterface;
use \Magento\Framework\Logger\Handler\Base;
use Magento\Framework\Module\Dir\Reader;


class FileSystem extends Base
{

    protected $moduleName = 'Training_S1v1';

    public function __construct(DriverInterface $filesystem,
                                 Reader $moduleReader,
                                 $filePath = 'var/log',
                                $fileName = 'dhl.log')
    {
       $modulePath = $moduleReader->getModuleDir('', $this->moduleName);
       $filePath = $modulePath .str_replace('/', DIRECTORY_SEPARATOR, $filePath);
       parent::__construct($filesystem, $filePath);
    }

}