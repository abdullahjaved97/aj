<?php
namespace Wallsandfloors\PM\Setup;

class InstallSchema implements \Magento\Framework\Setup\InstallSchemaInterface
{

	public function install(\Magento\Framework\Setup\SchemaSetupInterface $setup, \Magento\Framework\Setup\ModuleContextInterface $context)
	{
		$installer = $setup;
		$installer->startSetup();
		if (!$installer->tableExists('promotional_messages')) {
			$table = $installer->getConnection()->newTable(
				$installer->getTable('promotional_messages')
			)
				->addColumn(
					'id',
					\Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
					null,
					[
						'identity' => true,
						'nullable' => false,
						'primary'  => true,
						'unsigned' => true,
					]
				)
				->addColumn(
					'message',
					\Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
					255,
					['nullable => false']
				)
				->addColumn(
					'url',
					\Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
					255,
					['nullable => false']
				)->addColumn(
					'start_date',
					\Magento\Framework\DB\Ddl\Table::TYPE_DATE,
					null
                )->addColumn(
					'end_date',
					\Magento\Framework\DB\Ddl\Table::TYPE_DATE,
					null
                )->addColumn(
					'hex_background_colour',
					\Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
					255,
                    ['nullable => false']
                )->addColumn(
					'hex_text_colour',
					\Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
					255,
                    ['nullable => false']
                )->addColumn(
					'order',
					\Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
					255,
                    ['nullable => false']
                )->addColumn(
                    'store_id',
                    \Magento\Framework\DB\Ddl\Table::TYPE_SMALLINT,
                    null,
                    ['unsigned' => true, 'nullable' => false]
                )->addForeignKey(
                    $installer->getFkName('promotional_messages', 'store_id', 'store', 'store_id'),
                    'store_id',
                    $installer->getTable('store'),
                    'store_id',
                    \Magento\Framework\DB\Ddl\Table::ACTION_NO_ACTION
                )->addColumn(
					'status',
					\Magento\Framework\DB\Ddl\Table::TYPE_SMALLINT,
                    null,
                    ['nullable' => false, 'default' => '1']
                );
			$installer->getConnection()->createTable($table);

			$installer->getConnection()->addIndex(
				$installer->getTable('promotional_messages'),
				$setup->getIdxName(
					$installer->getTable('promotional_messages'),
					['message','url','start_date','end_date','hex_background_colour','hex_text_colour','order','store_id','status'],
					\Magento\Framework\DB\Adapter\AdapterInterface::INDEX_TYPE_FULLTEXT
				),
				['message','url','start_date','end_date','hex_background_colour','hex_text_colour','order','store_id','status'],
				\Magento\Framework\DB\Adapter\AdapterInterface::INDEX_TYPE_FULLTEXT
			);
		}
		$installer->endSetup();
	}
}
?>

