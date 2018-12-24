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
 * @category   ilovemarketing_news
 * @package    resource model news.php
 * @author     José Luis Rojo Sánchez <jose@artegrafico.net>
 * @copyright  Copyright (c) artegrafico.net (https://www.artegrafico.net/)
 * @license    http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 * @version    0.0.1
 *
 */

namespace Ilovemarketing\News\Model\ResourceModel; 

use Magento\Framework\Model\ResourceModel\Db\AbstractDb; 
use Magento\Framework\Model\AbstractModel;

class News extends AbstractDb {  
    
    protected $_serializableFields =  [ 'news_image' => [null, []] ]; 
    protected $_idFieldName = 'news_id';
    
    protected function _construct()  { 
        
        $this->_init(
            'ilovemarketing_news', 'news_id'
        );  
        
    } 
    
    /*protected function _beforeSave ( AbstractModel $object ) {         
        if (is_array($this->getValue())) {
            $this->setValue($this->serializer->serialize($this->getValue()));
        }
        parent::beforeSave();
        return $this;
    }    
    protected function _afterSave( AbstractModel $object ) { 
        $value = $this->getValue();
        if (!is_array($value)) {
            $this->setValue(empty($value) ? false : $this->serializer->unserialize($value));
        }
    }*/
    
} 