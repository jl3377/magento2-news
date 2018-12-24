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

namespace Ilovemarketing\News\Block\Adminhtml\News\Edit;

use Magento\Framework\View\Element\UiComponent\Control\ButtonProviderInterface;
use Magento\Store\Model\StoreManagerInterface;

class PreviewButton extends GenericButton implements ButtonProviderInterface {
    
    public function __construct( 
            StoreManagerInterface $storeManager ) {
        
        $this->_storeManager = $storeManager;
        
    }
    
    public function getButtonData() {
        
        return [
            'label' => __('Preview'),
            'on_click' => sprintf("location.href = '%s';", $this->getPreviewUrl()),
            'class' => 'preview',
            'sort_order' => 10
        ];
        
    }

    public function getPreviewUrl() {
        
        
        $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
        $news = $objectManager->get('Magento\Framework\Registry')->registry('news_id');//get current category
        
        
        $url = $this->_storeManager->getStore()->getBaseUrl();
        //$url .= 'news/index/view/id/'.$news->getId();
        
        return $url;
        
        //return $this->getUrl('http://www.artegrafico.net');
        
    }
    
}