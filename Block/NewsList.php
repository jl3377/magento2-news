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
 * @package    NewsList.php - block
 * @author     José Luis Rojo Sánchez <jose@artegrafico.net>
 * @copyright  Copyright (c) artegrafico.net (https://www.artegrafico.net/)
 * @license    http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 * @version    0.0.1
 *
 */

namespace Ilovemarketing\News\Block;

use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;
use Magento\Framework\UrlInterface; // urls
use Ilovemarketing\News\Model\ResourceModel\News\NewsFactory;
use Ilovemarketing\News\Helper\NewsConfig;


class NewsList extends Template {   
    
    public function __construct( Context $context, 
                                 NewsFactory $newsFactory,
                                 NewsConfig $newsConfig,
                                 UrlInterface $urlInterface) {            
        
        $this->_newsFactory = $newsFactory;    
        $this->_newsConfig = $newsConfig;      
        $this->_urlInterface = $urlInterface;
        // podemos usar ahora sus metodos getBaseUrl(), getUrl(), getCurrentUrl(), getUrl('test/test2') etc ..
         
        parent::__construct($context);          
        
        // get the title, description and keywords from conf
        $this->pageConfig->getTitle()->set(__($this->getConfig('ilovemarketing/news/newsTitle'))); 
        $this->pageConfig->setDescription($this->getConfig('ilovemarketing/newsMeta/newsMetaDescription')); 
        $this->pageConfig->setKeywords($this->getConfig('ilovemarketing/newsMeta/newsMetaKeywords'));         
        
    }

    /*public function addbreadcrumb() {
        
        // @var \Magento\Theme\Block\Html\Breadcrumbs 
        $breadcrumbs = $this->getLayout()->getBlock('breadcrumbs');
        $breadcrumbs->addCrumb('home',
            [
                'label' => __('Inicio'),
                'title' => __('Home'),
                'link' => $this->_urlInterface->getUrl()
            ]
        );
        $breadcrumbs->addCrumb('news',
            [
                'label' => __('Noticias'),
                'title' => __('Noticias'),
                'link' => $this->_urlInterface->getCurrentUrl()
            ]
        );     
        
        return $this->getLayout()->getBlock('breadcrumbs')->toHtml();
    }*/
    
   public function getNews()  {    
        
        // get limit fields from configuration 
        $this->_limit = $this->getConfig('ilovemarketing/news/newsLimit');
        
        // Sino ha parametro recibido de pagina, defecto 1
        $page=($this->getRequest()->getParam('p'))? $this->getRequest()->getParam('p') : 1;
        
        // limite de registros
        $pageSize = ($this->getRequest()->getParam('limit'))? $this->getRequest()->getParam('limit') : $this->_limit;

        $news = $this->_newsFactory->create();    
        $news->addFieldToFilter('news_visible',1)
             //->addFieldToFilter('store_id', array( 'in' => $this->getStoreId()))
             ->setOrder('news_date','desc')
             ->setPageSize($pageSize)
             ->setCurPage($page);
        
        return $news;       
        
    }         
    
    /*
     * El metodo callBack _prepareLayout()
     * Se lanza despues de que un bloque ha sido añadido al layout
     */
    protected function _prepareLayout() {
        
        parent::_prepareLayout();

        if ($this->getNews()) {
            
            $pager = $this->getLayout()->createBlock(
                'Magento\Theme\Block\Html\Pager',
                'news.news.pager'
            )->setAvailableLimit( 
                    [ 
                        5=>5, 
                        10=>10, 
                        15=>15,
                        25=>25
                    ] 
             )
             ->setShowPerPage(true)
             ->setLimit($this->_limit)             
             ->setCollection($this->getNews());
            
            $this->setChild('pager', $pager);            
            
        }
        
    }
    
    /* 
     * método callbBack getPagerHtml()
     * Será llamado antes de que el bloque html sea renderizado
     */
    public function getPagerHtml() {
        
        return $this->getChildHtml('pager');
        
    }       
    
    /*
     * get the title from configuration file
     * /helper/NewsConfig.php
     */
    public function getConfig($path) {
        return $this->_newsConfig->getConfig($path);
    }
    
    public function getStoreId() {
        return $this->_storeManager->getStore()->getId();
    }    
        
    
}


