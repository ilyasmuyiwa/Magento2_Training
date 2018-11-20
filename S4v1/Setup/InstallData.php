<?php
/**
 * Created by PhpStorm.
 * User: liyassoladogun
 * Date: 11/18/18
 * Time: 9:16 PM
 */

namespace Training\S4v1\Setup;


use Magento\Framework\Setup\InstallDataInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;

class InstallData implements InstallDataInterface
{
   public function install(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
   {
       $installer = $setup;
       $installer->startSetup();
       if(version_compare($context->getVersion(),'0.0.3', '<')) {
         $vendorData = [
             [
                 'vendor_name' => 'Vendor 1',
                 'zip' => 'ZIP1CODE',
                 'product_id' => 1
             ]
         ];

         foreach ($vendorData as $bindVendorData) {
             $installer->getConnection()
                 ->insertForce($installer->getTable('vendor'), $bindVendorData);
         }

           $vendorTypeData = [
               [
                   'type' => 'local',
                   'vendor_id' => 1,

               ],
               [
                   'type' => 'remote',
                   'vendor_id' => 2,

               ],
               [
                   'type' => 'local',
                   'vendor_id' => 3,

               ],
           ];

           foreach ($vendorTypeData as $bindVendorTypeData) {
               $installer->getConnection()
                   ->insertForce($installer->getTable('vendor_type'), $bindVendorTypeData);
           }

       }

       $installer->endSetup();
   }
}