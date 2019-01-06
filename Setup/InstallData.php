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
 * @package    InstallData.php
 * @author     José Luis Rojo Sánchez <jose@artegrafico.net>
 * @copyright  Copyright (c) artegrafico.net (https://www.artegrafico.net/)
 * @license    http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 * @version    0.0.1
 *
 */

namespace Ilovemarketing\News\Setup;
 
use Magento\Framework\Module\Setup\Migration;
use Magento\Framework\Setup\InstallDataInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
 
class InstallData implements InstallDataInterface {    
 
   private $_table = [
        'news' => 'ilovemarketing_news', 
        'news_types' => 'ilovemarketing_news_types',
        'news_categories' => 'ilovemarketing_news_categories'
    ];  
 

    public function install(
            ModuleDataSetupInterface $installer, 
            ModuleContextInterface $context) {
        
        $installer->startSetup();
        if (version_compare($context->getVersion(), '0.0.1', '<')) {
            
            $data = [ 
                ['Noticia 1', 'Noticia de prueba 1'],
                ['Noticia 2', 'Noticia de prueba 2'],
                ['Noticia 3', 'Noticia de prueba 3'],
                ['Noticia 4', 'Noticia de prueba 4'],
                ['Noticia 5', 'Noticia de prueba 5'],
                ['Noticia 6', 'Noticia de prueba 6'],
                ['Noticia 7', 'Noticia de prueba 7'],
                ['Noticia 8', 'Noticia de prueba 8'],
                ['Noticia 9', 'Noticia de prueba 9'],
                ['Noticia 10', 'Noticia de prueba 10']
                ];
                      
            foreach ($data as $key => $dataField) {
                
                $bind = [
                       'news_title' => $dataField[0],
                       'news_content' => $dataField[1]
                ];
                $installer->getConnection()->insert(
                    $installer->getTable($this->_table['news']),
                    $bind
                );
            }   
            
            // content news_types
            $data = [ 
                ['Borrrador'],
                ['Publicada'],
                ['Papelera']
            ];
            
            foreach ($data as $key => $dataField) {
                
                $bind = [                       
                       'news_type_name' => $dataField[0]
                ];
                $installer->getConnection()->insert(
                    $installer->getTable($this->_table['news_types']),
                    $bind
                );
            }   
            
            // content news_categories
            $data = [ 
                ['Noticias']
            ];
            
            foreach ($data as $key => $dataField) {
                
                $bind = [                       
                    'news_categorie_name' => $dataField[0]
                ];
                $installer->getConnection()->insert(
                    $installer->getTable($this->_table['news_categories']),
                    $bind
                );
            }   
            
            
        }
        $installer->endSetup();
        
    }
}    
