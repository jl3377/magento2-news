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

namespace Ilovemarketing\News\Ui\Component\Listing\Column;

use Magento\Framework\View\Element\UiComponent\ContextInterface;
use Magento\Framework\View\Element\UiComponentFactory;
use Magento\Ui\Component\Listing\Columns\Column;
use Magento\Framework\UrlInterface;
use Magento\Cms\Block\Adminhtml\Page\Grid\Renderer\Action\UrlBuilder;
use Magento\Store\Model\StoreManagerInterface;

class Store extends Column {

    protected $urlBuilder;
    protected $priceFormatter;
    protected $actionUrlBuilder;
    protected $_storeManager;    
    

    public function __construct(
        ContextInterface $context,
        UiComponentFactory $uiComponentFactory,
        UrlInterface $urlBuilder,
        UrlBuilder $actionUrlBuilder,        
        StoreManagerInterface $storeManager,
        array $components = [],
        array $data = [] ) {
        
        $this->urlBuilder = $urlBuilder;
        $this->actionUrlBuilder = $actionUrlBuilder;        
        $this->_storeManager = $storeManager;
        parent::__construct($context, $uiComponentFactory, $components, $data);
    }

    public function prepareDataSource(array $dataSource) {
        
       if (isset($dataSource['data']['items'])) {            
            
            // get rows
            foreach ($dataSource['data']['items'] as & $item) {
                                
                // get stores from shop
                $stores = $this->_storeManager->getStores(true, false);
                foreach($stores as $store){                                        
                    if($store->getId() === $item['store_id']){                            
                        $storeView = $store->getName();        
                        if ($item['store_id'] == 0) { $storeView =  __('All Stores'); } 
                     }  
                } 
                $item[$this->getData('name')] = $storeView;
            }
        }
        return $dataSource;
    }
    
}