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
 * @package    Link.php - link at top
 * @author     José Luis Rojo Sánchez <jose@artegrafico.net>
 * @copyright  Copyright (c) artegrafico.net (https://www.artegrafico.net/)
 * @license    http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 * @version    0.0.1
 *
 */

namespace Ilovemarketing\News\Block;
 
class Link extends \Magento\Framework\View\Element\Html\Link {

    protected function _toHtml() {
        
        if (false != $this->getTemplate()) {
            return parent::_toHtml();
        }
        
        return '<li><a ' . $this->getLinkAttributes() . ' >' . $this->escapeHtml($this->getLabel()) . '</a></li>';
    }
    
}