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

use Magento\Backend\Block\Widget\Context;
use Magento\Framework\Registry;
//use Magento\Search\Controller\RegistryConstants;

/**
 * Class GenericButton
 */
class GenericButton {
    
    /**
     * Url Builder
     *
     * @var \Magento\Framework\UrlInterface
     */
    protected $urlBuilder;

    /**
     * Registry
     *
     * @var \Magento\Framework\Registry
     */
    protected $registry;

    /**
     * Constructor
     *
     * @param \Magento\Backend\Block\Widget\Context $context
     * @param \Magento\Framework\Registry $registry
     */
    public function __construct(
            
        Context $context,
        Registry $registry ) {
        
        $this->urlBuilder = $context->getUrlBuilder();
        $this->registry = $registry;
        
    }

    /**
     * Return the synonyms group Id.
     *
     * @return int|null
     */
    public function getId() {
        
        $contact = $this->registry->registry('news');
        return $contact ? $contact->getId() : null;
        
    }

    /**
     * Generate url by route and parameters
     *
     * @param   string $route
     * @param   array $params
     * @return  string
     */
    public function getUrl($route = '', $params = []) {
        
        return $this->urlBuilder->getUrl($route, $params);
        
    }
}