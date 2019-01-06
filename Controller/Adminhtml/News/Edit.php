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
 * @package    Edit.php - edit fields
 * @author     José Luis Rojo Sánchez <jose@artegrafico.net>
 * @copyright  Copyright (c) artegrafico.net (https://www.artegrafico.net/)
 * @license    http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 * @version    0.0.1
 *
 */

namespace Ilovemarketing\News\Controller\Adminhtml\News;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;
use Ilovemarketing\News\Model\ResourceModel\News\NewsFactory;
 
class Edit extends Action {    
        
    protected $_pageFactory;
    //protected $news_array;
    
    public function __construct( Context $context,    
                                 PageFactory $pageFactory,
                                 NewsFactory $newsFactory
    ) {            
        
        $this->_pageFactory = $pageFactory;  
        $this->_newsFactory = $newsFactory;                 
        parent::__construct($context);    
        
    }    
    
    public function getNewsInfo(){
          
        $news_id = $this->getRequest()->getParam('id');
        $new = $this->_newsFactory->create()
                ->addFieldToFilter('news_id', $news_id)
                ->getData();
        
        foreach ($new as $value) {
            $info = [ 
                'news_title' => $value["news_title"]                     
            ];                         
        }
        return $info;
    }     
    
    public function execute() {
        
        $_page = $this->_pageFactory->create();         
        
        // if news send from post
        if ($this->getRequest()->getParam('news')) { 
            
            $newsArray = $this->getRequest()->getParam('news');        
            $_news = $this->_objectManager->create(News::class);
            $_news->setData($newsArray)->save();            
            
            $resultRedirect = $this->resultRedirectFactory->create();           
            return $resultRedirect->setPath('*/*/index');
            
        } 
        
        if ($this->getRequest()->getParam('id')) {
            $_page->getConfig()->getTitle()->prepend($this->getNewsInfo()["news_title"]);
        }
        return $_page;   
    }
}

