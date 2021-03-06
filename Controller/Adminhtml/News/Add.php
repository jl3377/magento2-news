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
 * @package    Add.php - add news functionality
 * @author     José Luis Rojo Sánchez <jose@artegrafico.net>
 * @copyright  Copyright (c) artegrafico.net (https://www.artegrafico.net/)
 * @license    http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 * @version    0.0.1
 *
 */

namespace Ilovemarketing\News\Controller\Adminhtml\News;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Backend\Model\View\Result\ForwardFactory;

class Add extends Action {
    
    protected $_forwardFactory;
    
    public function __construct(
            Context $context,
            ForwardFactory $forwardFactory ) {
        
        $this->_forwardFactory = $forwardFactory;
        parent::__construct($context);
        
    }
    
    public function execute() {
        
        //return $this->resultPageFactory->create();
        $resultForward = $this->_forwardFactory->create();
        return $resultForward->forward('edit');

    }
}

