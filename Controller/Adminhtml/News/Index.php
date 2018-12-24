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
 * @package    Adminhtml/News/Index.php - Controller
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

class Index  extends Action  {
    
    protected $_pageFactory;
    
    public function __construct( Context $context,    
                                 PageFactory $pageFactory  ) {    
        
        parent::__construct($context);    
        $this->_pageFactory = $pageFactory;  
        
    }     
    
    public function execute() {
        
        $_page = $this->_pageFactory->create();            
        $_page->getConfig()->getTitle()->prepend(__('Noticias'));
        return $_page;
                
    }
    
}