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
 * @package    ilovemarketing_news
 * @author     José Luis Rojo Sánchez <jose@artegrafico.net>
 * @copyright  Copyright (c) artegrafico.net (https://www.artegrafico.net/)
 * @license    http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 * @version    0.0.1
 *
 */

namespace Ilovemarketing\News\Ui\Component\Listing\Column;

use Magento\Ui\Component\Listing\Columns\Column;
use Magento\Framework\View\Element\UiComponentFactory;
use Magento\Framework\View\Element\UiComponent\ContextInterface;
use Magento\Framework\UrlInterface;
use Magento\Framework\Serialize\Serializer\Json;

class Thumbnail extends Column {
    
    protected $_jsonHelper;
    
    public function __construct(
        ContextInterface $context,            
        UiComponentFactory $uiComponentFactory,
        UrlInterface $urlBuilder,        
        Json $jsonHelper,
        array $components = [],
        array $data = []
    ) {
        parent::__construct($context, $uiComponentFactory, $components, $data);
        
        $this->_urlBuilder = $urlBuilder;  
        $this->_jsonHelper = $jsonHelper;
    }

    public function prepareDataSource(array $dataSource) {
        
        if (isset($dataSource['data']['items'])) {
            
            // nombre del campo "news_image" 
            $fieldName = $this->getData('name');            
            
            // Recorremos todas las filas del grid
            foreach ($dataSource['data']['items'] as & $item) {         
                
                // deserializamos el campo imagen
                //$imageArray = unserialize($item["news_image"]);
                if ($item["news_image"]) {
                    $imageArray = $this->_jsonHelper->unserialize($item["news_image"]);
                } else {  $imageArray = null; }
                
                if (!empty($imageArray)) {
                                 
                    // Completamos las variables del template de la imagen
                    // attr: {src: $col.getSrc($row()), alt: $col.getAlt($row())}
                    $item[$fieldName . '_src'] = $imageArray[0]['url']; 
                    $item[$fieldName . '_orig_src'] = $imageArray[0]['url']; 
                    $item[$fieldName . '_alt'] = $imageArray['0']['name'];
                    $item[$fieldName . '_link'] = $this->_urlBuilder->getUrl(
                        'ilm/news/edit', // controlador edicion 
                        ['id' => $item['news_id']] // parametros 
                    );
                }
            }
        }

        return $dataSource;
    }       
}