<?php
/* 
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade this extension to newer
 * version in the future.
 * 
 * @category   Ilovemarketing_News
 * @package    installschema.php for news module
 * @author     José Luis Rojo Sánchez <jose@artegrafico.net>
 * @copyright  Copyright (c) artegrafico.net (https://www.artegrafico.net/)
 * @license    http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 * @version    0.0.1
 *
 */

namespace Ilovemarketing\News\Setup; 

use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\DB\Adapter\AdapterInterface;
use Magento\Framework\DB\Ddl\Table;


class InstallSchema implements InstallSchemaInterface {     
    
    private $_table = [
        'news' => 'ilovemarketing_news', 
        'news_types' => 'ilovemarketing_news_types',
        'news_categories' => 'ilovemarketing_news_categories'
    ];    
    
    public function install(
            SchemaSetupInterface $setup, 
            ModuleContextInterface $context) {         
        
        $installer = $setup;         
        $installer->startSetup();  
            
        if (!$installer->getConnection()->isTableExists($setup->getTable($this->_table['news']))) {
        
            $table = $installer->getConnection()
                    ->newTable($installer->getTable($this->_table['news']))
                    ->addColumn('news_id', Table::TYPE_SMALLINT, null, ['identity' => true, 'nullable' => false, 'primary' => true, 'unsigned' => true], 'News ID')
                    ->addColumn('store_id', Table::TYPE_SMALLINT, null, ['nullable' => false, 'unsigned' => true], 'Store ID')
                    ->addColumn('news_type_id', Table::TYPE_SMALLINT, null, ['nullable' => false, 'unsigned' => true], 'News Type ID')
                    ->addColumn('news_title', Table::TYPE_TEXT, 255, ['nullable' => false], 'News Title')
                    ->addColumn('news_content', Table::TYPE_TEXT, '2M', [], 'News Content')
                    ->addColumn('news_date', Table::TYPE_TIMESTAMP, null, ['nullable' => false, 'default' => Table::TIMESTAMP_INIT], 'News Creation Time')
                    ->addColumn('news_visible', Table::TYPE_SMALLINT, null, ['nullable' => false, 'unsigned' => true], 'News Visible')
                    ->addColumn('news_image', Table::TYPE_TEXT, '2M', [], 'News Image')
                    ->addIndex($setup->getIdxName($installer->getTable($this->_table['news']), ['news_title'], AdapterInterface::INDEX_TYPE_FULLTEXT), ['news_title'], ['type' => AdapterInterface::INDEX_TYPE_FULLTEXT]) 
                    ->setComment('ilovemarketing_news - Table')
                    ->setOption('type', 'InnoDB')
                    ->setOption('charset', 'utf8');
            
            $installer->getConnection()->createTable($table);                     
            
        }    
        
        if (!$installer->getConnection()->isTableExists($setup->getTable($this->_table['news_types']))) {
            
            $table = $installer->getConnection()
                    ->newTable($installer->getTable($this->_table['news_types']))
                    ->addColumn('news_type_id', Table::TYPE_SMALLINT, null, ['identity' => true, 'nullable' => false, 'primary' => true, 'unsigned' => true], 'News Type ID')
                    ->addColumn('news_type_name', Table::TYPE_TEXT, 255, ['nullable' => false], 'News Type Name')                                        
                    ->setComment('ilovemarketing_news_types - Table')
                    ->setOption('type', 'InnoDB')
                    ->setOption('charset', 'utf8');
            
            $installer->getConnection()->createTable($table);                     
            
        }    
        
        if (!$installer->getConnection()->isTableExists($setup->getTable($this->_table['news_categories']))) {
            
            $table = $installer->getConnection()
                    ->newTable($installer->getTable($this->_table['news_categories']))
                    ->addColumn('news_categorie_id', Table::TYPE_SMALLINT, null, ['identity' => true, 'nullable' => false, 'primary' => true, 'unsigned' => true], 'News Categorie ID')
                    ->addColumn('news_categorie_name', Table::TYPE_TEXT, 255, ['nullable' => false], 'News Categorie Name')                                        
                    ->setComment('ilovemarketing_news_categories - Table')
                    ->setOption('type', 'InnoDB')
                    ->setOption('charset', 'utf8');
            
            $installer->getConnection()->createTable($table);                     
            
        }          
        
        $installer->endSetup();     
    }     
} 