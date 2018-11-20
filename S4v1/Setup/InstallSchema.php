<?php
/**
 * Created by PhpStorm.
 * User: liyassoladogun
 * Date: 11/18/18
 * Time: 8:33 PM
 */

namespace Training\S4v1\Setup;


use Magento\Framework\DB\Ddl\Table;
use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use MEQP2\Tests\NamingConventions\true\false;

class InstallSchema implements InstallSchemaInterface
{
    public function install(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $installer = $setup;
        $installer->startSetup();

        if(version_compare($context->getVersion(),'0.0.2', '<')){
            $table = $installer->getConnection()
                    ->newTable($installer->getTable('vendor'))
                    ->addColumn(
                        'vendor_id',
                        Table::TYPE_INTEGER,
                        null,
                        ['identity' => true, 'unsigned' => true, 'nullable' => false, 'primary' => true],
                        'Vendor Id'
                    )->addColumn(
                    'vendor_name',
                    Table::TYPE_TEXT,
                    255,
                    ['nullable' => false, 'unsigned' => true],
                    'Vendor Name'
                )->addColumn(
                        'zip',
                        Table::TYPE_TEXT,
                         255,
                        ['nullable' => false, 'unsigned' => true],
                        'Zip'
                )->addColumn(
                    'product_id',
                    Table::TYPE_INTEGER,
                    null,
                    ['nullable' => false, 'unsigned' => true],
                    'Product Id'
                )->addColumn(
                    'created_at',
                    Table::TYPE_TIMESTAMP,
                    null,
                    ['nullable' => false, 'default' => Table::TIMESTAMP_INIT],
                    'Created At'
                )->addColumn(
                    'updated_at',
                    Table::TYPE_TIMESTAMP,
                    null,
                    ['nullable' => false, 'default' => Table::TIMESTAMP_INIT_UPDATE],
                    'Updated At'
                )->addForeignKey(
                    $installer->getFkName(
                        'vendor',
                        'product_id',
                        'catalog_product_entity',
                        'entity_id'
                    ),
                        'product_id',
                        $installer->getTable('catalog_product_entity'),
                        'entity_id',
                        Table::ACTION_CASCADE

                );
            $installer->getConnection()->createTable($table);

        }
        $installer->endSetup();
    }

}