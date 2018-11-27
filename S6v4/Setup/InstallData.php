<?php
/**
 * Created by PhpStorm.
 * User: liyassoladogun
 * Date: 11/23/18
 * Time: 8:23 PM
 */

namespace Training\S6v4\Setup;

use Magento\Eav\Setup\EavSetupFactory;
use Magento\Framework\Setup\InstallDataInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Catalog\Model\Product;
use Training\S6v4\Model\Attribute\VendorCode\Backend;

class InstallData implements InstallDataInterface
{
    protected $eavSetupFactory;

    public function __construct(EavSetupFactory $eavSetupFactory)
    {
        $this->eavSetupFactory = $eavSetupFactory;
    }

    public function install(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {
        $setup->startSetup();
        $eavSetup = $this->eavSetupFactory->create(['setup' => $setup]);

        $eavSetup->updateAttribute(Product::ENTITY, 'vendor_code', [
           'backend' => Backend::class
        ]);

        $setup->endSetup();
    }

}