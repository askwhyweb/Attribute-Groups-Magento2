<?php

namespace OrviSoft\AttributeGroups\Setup;
/**
 *
 *  @author:    Farhan Islam <farhan@orvisoft.com>
 *  @module:    OrviSoft Attribute Groups (https://github.com/askwhyweb/Attribute-Groups-Magento2)
 *
**/
use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\DB\Ddl\Table;
use Magento\Framework\DB\Adapter\AdapterInterface;

class InstallSchema implements InstallSchemaInterface
{
    public function install(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $installer = $setup;

        $installer->startSetup();

        if (version_compare($context->getVersion(), '1.0.0') < 0){
          
          $installer->run('CREATE TABLE IF NOT EXISTS `attribute_groups`(  
            `id` INT NOT NULL AUTO_INCREMENT,
            `name` VARCHAR(256),
            `last_edit` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            PRIMARY KEY (`id`)
          )');

          $installer->run('CREATE TABLE IF NOT EXISTS `attribute_selection`(  
            `id` INT NOT NULL AUTO_INCREMENT,
            `title` VARCHAR(256),
            `parent_id` INT,
            `sort_by` INT,
            `attributes` TEXT,
            PRIMARY KEY (`id`)
          )');
        }
        
        $installer->endSetup();
    }
}