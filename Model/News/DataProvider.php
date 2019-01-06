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
 * @package    DataProvider - dataSource - ilm_news_lsiting
 * @author     José Luis Rojo Sánchez <jose@artegrafico.net>
 * @copyright  Copyright (c) artegrafico.net (https://www.artegrafico.net/)
 * @license    http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 * @version    0.0.1
 *
 */

namespace Ilovemarketing\News\Model\News;

use Ilovemarketing\News\Model\ResourceModel\News\NewsFactory;
use Magento\Ui\DataProvider\AbstractDataProvider;
use Magento\Framework\Serialize\Serializer\Json;

class DataProvider extends AbstractDataProvider {
   
    protected $_jsonHelper;
    
    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        NewsFactory $newsFactory,
        Json $jsonHelper,
        array $meta = [],
        array $data = [] ) {
        
        $this->collection = $newsFactory->create();
        $this->_jsonHelper = $jsonHelper;
        
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
    }

    public function getData(){
        
        if (isset($this->loadedData)) {
            return $this->loadedData;
        }

        $items = $this->collection->getItems();        
        $this->loadedData = array();                
        foreach ($items as $news) {      
            $this->loadedData[$news->getId()]['news'] = $news->getData();
        }
        
        // datos serializados
        if (!empty($items)) {
            
            $news_image = $this->loadedData[$news->getId()]['news']['news_image'];
            if (!empty($news_image)) {
            //$this->loadedData[$news->getId()]['news']['news_image'] = @unserialize($news_image);    
            $this->loadedData[$news->getId()]['news']['news_image'] = $this->_jsonHelper->unserialize($news_image);    
            }
        } 
                
        return $this->loadedData;

    }
    
  
}