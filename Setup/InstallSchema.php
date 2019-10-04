<?php

namespace PME\Testimonials\Setup;

use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\DB\Ddl\Table;

class InstallSchema implements InstallSchemaInterface
{
    /**
     * Install testimonials table
     *
     * @param SchemaSetupInterface $setup
     * @param ModuleContextInterface $context
     * @return void
     */
    public function install(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $installer = $setup;

        $installer->startSetup();

        $table = $installer->getConnection()
            ->newTable($installer->getTable('pme_testimonials'))
            ->addColumn(
                'testimonial_id',
                Table::TYPE_SMALLINT,
                null,
                ['identity' => true, 'nullable' => false, 'primary' => true],
                'Testimonial ID'
            )
            ->addColumn('title', Table::TYPE_TEXT, 150, ['nullable' => false], 'Title')
            ->addColumn('company_name', Table::TYPE_TEXT, 150, ['nullable' => false], 'User\'s Company name')
            ->addColumn('nick_name', Table::TYPE_TEXT, 150, ['nullable' => false], 'User\'s name')
            ->addColumn('email', Table::TYPE_TEXT, 150, ['nullable' => false], 'User\'s email')
            ->addColumn('company_website', Table::TYPE_TEXT, 150, ['nullable' => false], 'User\'s email')
            ->addColumn('avatar', Table::TYPE_TEXT, 350, ['nullable' => false], 'User\'s avatar')
            ->addColumn('content', Table::TYPE_TEXT, '2M', [], 'Testimonial Content')
            ->addColumn('rating', Table::TYPE_TEXT, 150, ['nullable' => false], 'Rating')
            ->addColumn('store', Table::TYPE_TEXT, 150, ['nullable' => false], 'Store View')
            ->addColumn('job', Table::TYPE_TEXT, 150, ['nullable' => false], 'Job')
            ->addColumn('address', Table::TYPE_TEXT, 150, ['nullable' => false], 'Address')
                // social media column
            ->addColumn('linkedin', Table::TYPE_TEXT, 150, ['nullable' => false], 'Linkedin')
            ->addColumn('facebook', Table::TYPE_TEXT, 150, ['nullable' => false], 'Facebook')
            ->addColumn('twitter', Table::TYPE_TEXT, 150, ['nullable' => false], 'Twitter')
            ->addColumn('youtube', Table::TYPE_TEXT, 150, ['nullable' => false], 'YouTube')
            ->addColumn('vimeo', Table::TYPE_TEXT, 150, ['nullable' => false], 'Viemo')

            ->addColumn('is_active', Table::TYPE_SMALLINT, null, ['nullable' => false, 'default' => '0'], 'Is Active?')
            ->addColumn('featured', Table::TYPE_SMALLINT, null, ['nullable' => false, 'default' => '0'], 'Featured Testimonials?')
            ->addColumn(
           'creation_time',
           \Magento\Framework\DB\Ddl\Table::TYPE_TIMESTAMP,
           null,
           ['nullable' => false, 'default' => \Magento\Framework\DB\Ddl\Table::TIMESTAMP_INIT],
           'Testimonials Creation Time'
       )->addColumn(
           'update_time',
           \Magento\Framework\DB\Ddl\Table::TYPE_TIMESTAMP,
           null,
           ['nullable' => false, 'default' => \Magento\Framework\DB\Ddl\Table::TIMESTAMP_INIT_UPDATE],
           'Testimonials Modification Time'
       )
            ->setComment('Testimonials');

        $installer->getConnection()->createTable($table);

        $installer->endSetup();
    }
}
