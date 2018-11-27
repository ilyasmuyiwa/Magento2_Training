<?php
/**
 * Created by PhpStorm.
 * User: liyassoladogun
 * Date: 11/21/18
 * Time: 5:22 PM
 */

namespace Training\S5v2\Setup;


use Magento\Eav\Setup\EavSetupFactory;
use Magento\Framework\Setup\InstallDataInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Training\S5v2\Model\Source\AddressType;
use Magento\Eav\Model\Config;

class InstallData implements InstallDataInterface
{
    protected $eavSetupFactory;

    protected $config;

    public function __construct(EavSetupFactory $eavSetupFactory,
                                Config $config)
    {
        $this->eavSetupFactory = $eavSetupFactory;
        $this->config = $config;
    }


    public function install(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {
       $setup->startSetup();

       $eavSetup = $this->eavSetupFactory->create(['setup' => $setup]);
       $eavSetup->addAttribute('customer_address', 'address_type', [
           'type' => 'varchar',
           'label' => 'Address Type',
           'input' => 'select',
           'is_visible' => true,
           'system' => false,
           'sort_order' => 20,
           'source' => AddressType::class
       ]);

       $attribute = $this->config->getAttribute('customer_address', 'address_type');
       $attribute->setData('used_in_forms', [
           'adminhtml_customer_address', 'customer_address_edit', 'customer_account_edit', 'customer_register_address'
       ])->save();

       $setup->endSetup();
    }

}