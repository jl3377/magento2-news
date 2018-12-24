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
 * @category   ilovemarketin_news
 * @package    news.php model
 * @author     José Luis Rojo Sánchez <jose@artegrafico.net>
 * @copyright  Copyright (c) artegrafico.net (https://www.artegrafico.net/)
 * @license    http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 * @version    0.0.1
 *
 */

namespace Ilovemarketing\News\Model; 

use Magento\Framework\Model\AbstractModel; 

class News extends AbstractModel {  
    
    const _ENABLED = 1;
    const _DISABLED = 0;
    
    protected function _construct()  {    
        $this->_init('Ilovemarketing\News\Model\ResourceModel\News');  
        
    }     
    
    public function getVisibility() {
        
        return [
            self::_ENABLED => __('Enabled'), 
            self::_DISABLED => __('Disabled')
        ];
        
    }
    
}