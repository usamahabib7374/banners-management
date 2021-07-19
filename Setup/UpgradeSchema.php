<?php

namespace MageDad\BannerManagement\Setup;

use Magento\Framework\Setup\UpgradeSchemaInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\Setup\ModuleContextInterface;

class UpgradeSchema implements UpgradeSchemaInterface {

    public function upgrade(SchemaSetupInterface $setup, ModuleContextInterface $context) {
        $installer = $setup;

        $installer->startSetup();
        if (version_compare($context->getVersion(), '1.0.1', '<')) {
            $installer->getConnection()->addColumn(
                    $installer->getTable('magedad_bannerslider_banner'), 'product_id', [
                'type' => \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                'unsigned' => true,
                'nullable' => true,
                'index' => true,
                'comment' => '`product_id`'
                    ]
            );
            $installer->getConnection()->addForeignKey(
                    $installer->getFkName(
                            'magedad_bannerslider_banner', 'product_id', 'catalog_product_entity', 'entity_id'
                    ), 'magedad_bannerslider_banner', 'product_id', $installer->getTable('catalog_product_entity'), 'entity_id', \Magento\Framework\DB\Ddl\Table::ACTION_CASCADE
            );
        }
        if (version_compare($context->getVersion(), '1.0.4', '<')) {
            $installer->getConnection()->addColumn(
                    $installer->getTable('magedad_bannerslider_banner'), 'name_ar', [
                'type' => \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                'unsigned' => true,
                'nullable' => true,
                'index' => true,
                'comment' => '`name_ar`'
                    ]
            );
            $installer->getConnection()->addColumn(
                    $installer->getTable('magedad_bannerslider_banner'), 'title_ar', [
                'type' => \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                'unsigned' => true,
                'nullable' => true,
                'index' => true,
                'comment' => '`title_ar`'
                    ]
            );
        }
        $installer->endSetup();
    }

}
