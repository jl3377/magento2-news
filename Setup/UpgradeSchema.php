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
 * @category   artegrafico.net
 * @package    artegrafico.net
 * @author     José Luis Rojo Sánchez <jose@artegrafico.net>
 * @copyright  Copyright (c) artegrafico.net (https://www.artegrafico.net/)
 * @license    http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 * @version    0.0.1
 *
 */

namespace Ilovemarketing\News\Setup;

use Magento\Framework\Setup\UpgradeSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;


class UpgradeSchema implements UpgradeSchemaInterface {

   private $_table = [
        'news' => 'ilovemarketing_news', 
        'news_types' => 'ilovemarketing_news_types',
        'news_categories' => 'ilovemarketing_news_categories'
    ];  
    
    public function upgrade(
            SchemaSetupInterface $setup, 
            ModuleContextInterface $context) {
        
        $installer = $setup;                 
        $installer->startSetup();

        // update version
        // en este upgrade vamos a incluir un nuevo campo    
        if (version_compare($context->getVersion(), '0.0.1', '<')) {

            $tableName = $installer->getTable($this->_table['news']);
            $installer->getConnection()->addColumn($tableName, 'news_comment', [
                'type' => \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                'length'    => 255,
                'unsigned' => true,
                'nullable' => false,
                'default' => '0',
                'comment' => 'Comment'
            ]);
            
            // update de nuestra version 
            // en este upgrade vamos acrear unos indexers para poder realizar busquedas
       
            // otro forma de incluir una columna
            $column = [        
               'type' => \Magento\Framework\DB\Ddl\Table::TYPE_SMALLINT,        
               'length' => 1,        
               'nullable' => false,        
               'comment' => 'Es visible',        
               'default' => '1'      
            ];      
            
            $installer->getConnection()->addColumn($this->_table['news'], 'news_visible', $column);
            
        } 
        
        $installer->endSetup();
    }
}
