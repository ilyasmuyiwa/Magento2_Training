<?php
/**
 * Created by PhpStorm.
 * User: liyassoladogun
 * Date: 11/22/18
 * Time: 10:59 AM
 */

namespace Training\S5v5\Setup;


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

        $eavSetup->addAttribute(Product::ENTITY, 'manufacturer_code', [
            'global' => ScopedAttributeInterface::SCOPE_GLOBAL,
            'type' => 'varchar',
            'label' => 'Manufacturer Code',
            'input' =>  'text',
            'group' => 'General',
            'required' => false,
            'unique' => false,
            'is_used_in_grid' => true,
            'is_visible_in_grid' => true,
            'is_visible' => true,
            'visible_on_front' => true,
            'is_filterable_in_grid' => true,
            'filterable_in_search' => true,
            'is_filterable' => true,
            'is_searchable' => true,
            'is_html_allowed_on_front' => true
        ]);

        $setup->endSetup();
    }

}