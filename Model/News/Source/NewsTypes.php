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
 * @package    NewsTypesOptions.php
 * @author     José Luis Rojo Sánchez <jose@artegrafico.net>
 * @copyright  Copyright (c) artegrafico.net (https://www.artegrafico.net/)
 * @license    http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 * @version    0.0.1
 *
 */

namespace Ilovemarketing\News\Model\News\Source;

use Magento\Framework\Data\OptionSourceInterface;
use Ilovemarketing\News\Model\ResourceModel\News\NewsTypesFactory;

class NewsTypes implements OptionSourceInterface {
    
    protected $_newsTypesFactory;    
     
    public function __construct( NewsTypesFactory $NewsTypesFactory ) {
        
        $this->_newsTypesFactory = $NewsTypesFactory;        
       
    }    
    
    public function getNewsTypes() {
         
        return $this->_newsTypesFactory->create();       
         
    }    
    
    public function toOptionArray() {          
        
        foreach ($this->getNewsTypes() as $value) {
            $newsTypesArray[] = [
                'label' => $value["news_type_name"], 
                'value' => $value['news_type_id'] 
            ];
        }
        
        return $newsTypesArray;

    }
    
}