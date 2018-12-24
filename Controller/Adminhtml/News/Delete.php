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
 * @package    Delete.php
 * @author     José Luis Rojo Sánchez <jose@artegrafico.net>
 * @copyright  Copyright (c) artegrafico.net (https://www.artegrafico.net/)
 * @license    http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 * @version    0.0.1
 *
 */

namespace Ilovemarketing\News\Controller\Adminhtml\News;
use Ilovemarketing\News\Model\News as News;
use Magento\Backend\App\Action;

class Delete extends Action {
    
   public function execute() {
        
        // Parámetro recibido por URL
        $id = $this->getRequest()->getParam('id');

        if (!($news = $this->_objectManager->create(News::class)->load($id))) {
            
            $this->messageManager->addError(__('No se puede realizar la acción de borrado. Inténtelo de nuevo.'));
            $resultRedirect = $this->resultRedirectFactory->create();
            return $resultRedirect->setPath('*/*/index', array('_current' => true));
            
        } try {
            
            $news->delete();
            $this->messageManager->addSuccess(__('Tu registro ha sido borrado correctamente!'));
            
        } catch (Exception $e) {
            
            $this->messageManager->addError(__('Un error se ha producido mientras se borraba el registro: '));
            $resultRedirect = $this->resultRedirectFactory->create();
            return $resultRedirect->setPath('*/*/index', array('_current' => true));
            
        }

        $resultRedirect = $this->resultRedirectFactory->create();
        return $resultRedirect->setPath('*/*/index', array('_current' => true));
    }
}    