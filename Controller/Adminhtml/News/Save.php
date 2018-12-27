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
use Ilovemarketing\News\Model\News; 
use Magento\Store\Model\StoreManagerInterface;
use Magento\Framework\Exception\LocalizedException;

class Save extends Action {    
      
    protected $imageUploader;

    public function __construct(
        Context $context,
        StoreManagerInterface $storeManager ) {
        
        $this->_storeManager = $storeManager;         
        parent::__construct($context);
    }
    
    public function execute() {
        
        // Recibe los datos enviados por post
        $data = $this->getRequest()->getPostValue();
        $resultRedirect = $this->resultRedirectFactory->create();
        
        $this->_data = $data;
        
        // Comprobamos que se reciben datos
        if ($data) {       
            $id = $this->getRequest()->getParam('id');
            
            
            // Caso que tenga imagen la noticia
            if (isset($data['news']['news_image'][0]['name']) && isset($data['news']['news_image'][0]['tmp_name'])) {
                $data['image'] = $data['news']['news_image'][0]['name']; // nombre de la imagen    
                // dependencia para cargar imagenes
                $this->_imageUploader = \Magento\Framework\App\ObjectManager::getInstance()->get('Ilovemarketing\News\NewsImageUploader');
            } else { $data['image'] = null; }
            
               
            // Sino la imagen es enviada
            if (!empty($data['news']['news_image'])) {
                    
                // Recuperamos el path donde se gaurdan las imágenes
                $basePath = $this->_imageUploader->getBasePath();                   
                
                // Recuperamos el path completo de la imagen
                $baseImagePath = $this->_imageUploader->getFilePath($basePath, $data['image']);    
                $mediaUrl = $this->_storeManager->getStore()->getBaseUrl(\Magento\Framework\UrlInterface::URL_TYPE_MEDIA);                    
                    
                if ($data['news']['news_image'][0]['url'] != $mediaUrl.$baseImagePath) {                        
                    // asignamos la url definitiva a la imagen                    
                    $data['news']['news_image'][0]['url'] = $mediaUrl.$baseImagePath;         
                     // move image
                    $this->_imageUploader->moveFileFromTmp($data['image']);
                }    
            } 
             
            $model = $this->_objectManager->create('Ilovemarketing\News\Model\News')->load($id);
            //$model->setData($data['news']);            
            $model->setData($this->_data);            
            
            
            try {
                
                // guardamos datos            
                $model->save();      
                
                // message
                $this->messageManager->addSuccess(__('News saved correctly'));

                // save and continue buttom
                if ($this->getRequest()->getParam('back')) {
                    return $resultRedirect->setPath('*/*/edit', [
                        'id' => $model->getId(),
                        '_current' => true
                    ]);
                }  
            
            } catch (LocalizedException $e) {
                $this->messageManager->addError($e->getMessage());
            }
                
        }
        
        // redireccionamos a la pagina principal
        return $resultRedirect->setPath('*/*/');
    }
}    
