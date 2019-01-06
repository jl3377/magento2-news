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

namespace Ilovemarketing\News\Block\Widget;

use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;
use Magento\Widget\Block\BlockInterface;
use Ilovemarketing\News\Model\ResourceModel\News\NewsFactory;
use Magento\Framework\Serialize\Serializer\Json;

class NewsList extends Template implements BlockInterface {
    
    protected $_template = 'widget/newsList.phtml';
    
    public function __construct(
            Context $context, 
            NewsFactory $newsFactory,
            Json $jsonHelper,
            array $data = array()
    ) {
        
        $this->_jsonHelper = $jsonHelper;
        $this->_newsFactory = $newsFactory;        
        parent::__construct($context);
    }
    

   public function getNews()  {    
        
        // get parameter from news_count
        $limit= $this->getData('news_count');
       
        // get collection
        $this->_news = $this->_newsFactory->create();    
        $this->_news->addFieldToFilter('news_visible',1)
             ->setOrder('news_date','desc')                
             ->setPageSize($limit);
        
        return $this->_news;       
        
    }         
    
    public function unserializeImg($img) {        
        
        // unserialize data image (json)
        $url = $this->_jsonHelper->unserialize($img);            
        return $url[0]['url'];            
        
    }   
    
}