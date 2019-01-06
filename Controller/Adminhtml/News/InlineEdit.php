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

namespace Ilovemarketing\News\Controller\Adminhtml\News;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\Controller\Result\JsonFactory;
use Ilovemarketing\News\Model\News; 

class InlineEdit extends Action {
    
    protected $jsonFactory;
    
    public function __construct (
        Context $context,
        JsonFactory $jsonFactory ) {
        
        parent::__construct($context);
        $this->jsonFactory = $jsonFactory;
    }

    public function execute() {
        
        $resultJson = $this->jsonFactory->create();
        $error = false;
        $messages = [];

        if ($this->getRequest()->getParam('isAjax')) {
            
            // Todos los datos de nuestra grilla
            $items = $this->getRequest()->getParam('items', []);
            
            // Sino hay datos recibidos
            if (!count($items)) {
                $messages[] = __('Please correct the data sent.');
                $error = true;
            } else {                
                
                // Recorremos los datos
                foreach (array_keys($items) as $newsId) {          
                    
                    // nuestro modelo de datos 
                    $model = $this->_objectManager->create(News::class);
                    $model->load($newsId);
                    
                    // sino hay errores
                    try {
                        $model->setData(array_merge($model->getData(), $items[$newsId]));
                        $model->save();
                         
                    } catch (\Exception $e) {
                        $messages[] = $this->getErrorsNews(
                            $model,
                            __($e->getMessage())
                        );
                        $error = true;
                    }
                }
            }
        }

        return $resultJson->setData([
            'messages' => $messages,
            'error' => $error
        ]);
    }

    protected function getErrorsNews (News $news, $error) {
        return '[News ID: ' . $news->getId() . '] ' . $error;
    }
}
