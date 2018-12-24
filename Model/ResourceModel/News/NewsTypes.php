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
 * @category   ilvoemarketing_news
 * @package    NewsTypes.php collection
 * @author     José Luis Rojo Sánchez <jose@artegrafico.net>
 * @copyright  Copyright (c) artegrafico.net (https://www.artegrafico.net/)
 * @license    http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 * @version    0.0.1
 *
 */

namespace Ilovemarketing\News\Model\ResourceModel\News;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class NewsTypes extends AbstractCollection {
    
     protected $_idFieldName = 'news_type_id';
    
     protected function _construct()  {    
        $this->_init(
                'Ilovemarketing\News\Model\NewsTypes', 
                'Ilovemarketing\News\Model\ResourceModel\NewsTypes'
        );          
    } 
}
