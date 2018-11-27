<?php
/**
 * Created by PhpStorm.
 * User: liyassoladogun
 * Date: 11/21/18
 * Time: 4:13 PM
 */

namespace Training\S5v1\Setup;


use Magento\Eav\Setup\EavSetup;
use Magento\Framework\Setup\InstallDataInterface;
use Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface;
use Magento\Eav\Setup\EavSetupFactory;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Catalog\Model\Product;
use MEQP2\Tests\NamingConventions\true\false;
use Training\S5v1\Model\Attribute\Backend\VendorCode;


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
        /** @var EavSetup $eavSetup */
        $eavSetup = $this->eavSetupFactory->create(['setup' => $setup]);
        $eavSetup->addAttribute(Product::ENTITY, 'vendor_code', [
           'global' => ScopedAttributeInterface::SCOPE_GLOBAL,
            'backend' => VendorCode::class,
            'type' => 'varchar',
            'label' => 'Vendor Code',
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