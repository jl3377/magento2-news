<?php
/**
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
 * @category   Ilovemarketing_News
 * @package    News.php Controller
 * @author     José Luis Rojo Sánchez <jose@artegrafico.net>
 * @copyright  Copyright (c) artegrafico.net (https://www.artegrafico.net/)
 * @license    http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 * @version    0.0.1
 *
*/

namespace Ilovemarketing\News\Controller\Index;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;
 
class Index extends Action {
    
    protected $_pageFactory;
    
    public function __construct(
            Context $context, 
            PageFactory $pageFactory) {
        
        $this->_pageFactory = $pageFactory;        
        parent::__construct($context);        
       
    }    
    
    
    public function addbreadcrumb() {
        
        $pageFactory = $this->_pageFactory->create();
        
        // @var \Magento\Theme\Block\Html\Breadcrumbs 
        $breadcrumbs = $pageFactory->getLayout()->getBlock('breadcrumbs');
        $breadcrumbs->addCrumb('home',
            [
                'label' => __('Inicio'),
                'title' => __('Home'),
                'link' => $this->_url->getUrl('/')
            ]
        );
        $breadcrumbs->addCrumb('news',
            [
                'label' => __('Noticias'),
                'title' => __('Noticias'),
                'link' => $this->_url->getUrl('news')
            ]
        );      
    }
    
    public function execute() {        
        
        $page = $this->_pageFactory->create();
        $this->addbreadcrumb();
        return $page;
        
    }
}