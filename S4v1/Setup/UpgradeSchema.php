<?php
/**
 * Created by PhpStorm.
 * User: liyassoladogun
 * Date: 11/18/18
 * Time: 9:02 PM
 */

namespace Training\S4v1\Setup;


use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\Setup\UpgradeSchemaInterface;
use Magento\Framework\DB\Ddl\Table;

class UpgradeSchema implements UpgradeSchemaInterface
{
    public function upgrade(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $installer = $setup;
        $installer->startSetup();
        if(version_compare($context->getVersion(),'0.0.2', '<')) {
            $table = $installer->getConnection()
                ->newTable($installer->getTable('vendor_type'))
                ->addColumn(
                    'vendor_type_id',
                    Table::TYPE_INTEGER,
                    null,
                    ['identity' => true, 'unsigned' => true, 'nullable' => false, 'primary' => true],
                    'Vendor Type Id'
                )->addColumn(
                    'type',
                    Table::TYPE_TEXT,
                    30,
                    ['nullable' => false, 'unsigned' => true],
                    'Type'
                )->addColumn(
                    'vendor_id',
                    Table::TYPE_INTEGER,
                    255,
                    ['nullable' => false, 'unsigned' => true],
                    'Vendor Id'
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
                        'vendor_type',
                        'vendor_id',
                        'vendor',
                        'vendor_id'
                    ),
                    'vendor_id',
                    $installer->getTable('vendor'),
                    'vendor_id',
                    Table::ACTION_CASCADE

                );
            $installer->getConnection()->createTable($table);
        }
        $installer->endSetup();
    }

}