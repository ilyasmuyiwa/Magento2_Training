<?php
/**
 * Created by PhpStorm.
 * User: liyassoladogun
 * Date: 11/20/18
 * Time: 8:57 PM
 */

namespace Training\S4v2\Setup;


use Magento\Framework\DB\Ddl\Table;
use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;

class InstallSchema implements InstallSchemaInterface
{
    public function install(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $installer = $setup;

        $installer->startSetup();

        $tbl = $installer->getTable('catalog_product_option');
        $columns = [
            'is_virtual' =>
                [
                    'type' => Table::TYPE_SMALLINT,
                    'nullable' => false,
                    'default' => 0,
                    'size' => null,
                    'comment' => 'Is Virtual'
             ]
        ];

        $connection = $installer->getConnection();

        foreach ($columns as $name => $option) {
            $connection->addColumn($tbl, $name, $option);
        }

        $installer->endSetup();
    }

}