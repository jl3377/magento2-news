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
 * @category   ilovemarketing_newst
 * @package    Uninstall.php - Setup
 * @author     José Luis Rojo Sánchez <jose@artegrafico.net>
 * @copyright  Copyright (c) artegrafico.net (https://www.artegrafico.net/)
 * @license    http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 * @version    0.0.1
 *
 */

namespace Ilovemarketing\News\Setup;

use Magento\Framework\Setup\UninstallInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;

class Uninstalll implements UninstallInterface {
    
    private $_table = 'ilovemarketing_news';
     
    public function uninstall(
            SchemaSetupInterface $installer, 
            ModuleContextInterface $context) {
        
        $installer->startSetup();
        $tableName = $installer->getTable($this->_table);
        $installer->getConnection()->query("DROP ".$tableName);
        $installer->endSetup();
    }
}