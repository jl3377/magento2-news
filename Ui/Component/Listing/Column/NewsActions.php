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
 * @category   ilovemarkeing_news
 * @package    TestActions.php - ui component - news_news_listing - actionColum
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
use Magento\Framework\Escaper;
use Magento\Framework\App\ObjectManager;

class NewsActions extends Column {

    protected $_urlBuilder;
    private $escaper;

    public function __construct(
        ContextInterface $context,
        UiComponentFactory $uiComponentFactory,
        UrlInterface $urlBuilder,
        Escaper $escaper,
        array $components = [],
        array $data = []
    ) {
        
        $this->_urlBuilder = $urlBuilder;
        $this->_escaper = $escaper;
        parent::__construct($context, $uiComponentFactory, $components, $data);
        
    }

    public function prepareDataSource( array $dataSource ) {
        
        if (isset($dataSource['data']['items'])) {
            
            foreach ($dataSource['data']['items'] as &$item) {
                
                if (isset($item['news_id'])) {
                    
                    $newsTitle = $this->_escaper->escapeHtml($item['news_title']);

                    $item[$this->getData('name')]['edit'] = [
                        'href' => $this->_urlBuilder->getUrl(
                            'news/news/edit',
                            ['id' => $item['news_id']]
                        ),
                        'label' => __('Editar'),
                        'hidden' => false,
                    ];
                    $item[$this->getData('name')]['delete'] = [
                        'href' => $this->_urlBuilder->getUrl(
                            'news/news/delete',
                            ['id' => $item['news_id']]
                        ),
                        'label' => __('Borrar'),
                        'hidden' => false,
                        'confirm' => [
                            'title' => __('Delete %1', $newsTitle),
                            'message' => __('Are you sure you wan\'t to delete a: %1 record?', $newsTitle)
                        ]
                    ];
                    /*$item[$this->getData('name')]['preview'] = [
                        'href' => $this->_urlBuilder->getUrl(
                            'news/news/preview',
                            ['id' => $item['news_id']]
                        ),
                        'label' => __('Preview'),
                        'hidden' => false,
                    ];      */       
                }
            }
        }

        return $dataSource;
    }
    
}
