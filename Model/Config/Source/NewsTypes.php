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
 * @category   Ilovemarketing_news
 * @package    NewsTypes.php
 * @author     José Luis Rojo Sánchez <jose@artegrafico.net>
 * @copyright  Copyright (c) artegrafico.net (https://www.artegrafico.net/)
 * @license    http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 * @version    0.0.1
 *
 */

namespace Ilovemarketing\News\Model\Config\Source;

use Magento\Framework\View\Element\Template;
use Ilovemarketing\News\Model\ResourceModel\News\NewsTypesFactory;
use Magento\Framework\View\Element\Template\Context;

class NewsTypes extends Template {
    
    //protected $_configPath = 'news/newstypes';   
    protected $_newsTypesFactory;    
     
    public function __construct( 
            Context $context, 
            NewsTypesFactory $NewsTypesFactory ) {
        
        $this->_newsTypesFactory = $NewsTypesFactory;
        parent::__construct($context);  
       
    }
    
    public function getNewsTypes() {
         
        return $this->_newsTypesFactory->create();       
         
    }

    public function toOptionArray() {
        
        $newsTypesArray = [];
        foreach ($this->getNewsTypes() as $value) {
            $newsTypesArray[] = ['label' => $value["news_type_name"], 'value' => $value['news_type_id'] ];
        }
        return $newsTypesArray;
        
    }   
    
    /*public function toOptionArray() {
        
        $optionArray = [];
        $backendConfig = $this->_config->getValue($this->_configPath, 'default');
        if ($backendConfig) {
            foreach ($backendConfig as $formName => $formConfig) {
                if (!empty($formConfig['label'])) {
                    $optionArray[] = ['label' => $formConfig['label'], 'value' => $formName];
                }
            }
        }
        return $optionArray;
    }*/
    
}
