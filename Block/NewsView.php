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
 * @package    NewsView.php - Block
 * @author     José Luis Rojo Sánchez <jose@artegrafico.net>
 * @copyright  Copyright (c) artegrafico.net (https://www.artegrafico.net/)
 * @license    http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 * @version    0.0.1
 *
 */

namespace Ilovemarketing\News\Block;

use Magento\Framework\View\Element\Template; 
use Magento\Framework\View\Element\Template\Context;
use Ilovemarketing\News\Model\NewsFactory;

class NewsView extends Template {
    
    protected $_newsFactory;          
    public $_newsTitle;
  
    public function __construct( Context $context, 
                                 NewsFactory $newsFactory ) {    
        
        $this->_newsFactory = $newsFactory;       
        parent::__construct($context);  
        
    }
    
    
    public function getNewsId(){
          
         $news_id = $this->getRequest()->getParam('id');
         $news = $this->_newsFactory->create()->load($news_id);
         
         return $news;
    
    }

    /*
     * _prepareLayout() es lanzado nada mas inicializarse el bloque
     * por eso llamamos al metodo getNewsId() para conseguir su titulo
     */
    protected function _prepareLayout() {
         
        $this->pageConfig->getTitle()->set($this->getNewsId()["news_title"]);        
        /*$this->pageConfig->setDescription('Listado de Noticias'); // meta description
        $this->pageConfig->setKeywords('noticia, noticias'); // meta keywords*/
        return parent::_prepareLayout();
    
    }    
    
}
