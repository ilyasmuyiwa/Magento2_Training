<?php
/**
 * Created by PhpStorm.
 * User: liyassoladogun
 * Date: 11/22/18
 * Time: 10:59 AM
 */

namespace Training\S7v1\Setup;


use Magento\Eav\Setup\EavSetupFactory;
use Magento\Framework\Setup\InstallDataInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Catalog\Model\Product;
use Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface;

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
        $attributeId = $eavSetup->getAttributeId(Product::ENTITY, 'vendor_code');

        $eavSetup->updateAttribute(Product::ENTITY, $attributeId, [
            'apply_to' => 'simple,bundle,downloadable,configurable,grouped']);

        $setup->endSetup();
    }

}