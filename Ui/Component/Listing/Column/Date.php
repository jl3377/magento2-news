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
use Magento\Framework\Stdlib\DateTime\TimezoneInterface;
use Magento\Ui\Component\Listing\Columns\Column;

/**
 * Class Date.
 */
class Date extends Column {
    /**
     * @var TimezoneInterface
     */
    protected $timezone;

    /**
     * @param ContextInterface   $context
     * @param UiComponentFactory $uiComponentFactory
     * @param TimezoneInterface  $timezone
     * @param array              $components
     * @param array              $data
     */
    public function __construct(
        ContextInterface $context,
        UiComponentFactory $uiComponentFactory,
        TimezoneInterface $timezone,
        array $components = [],
        array $data = []
    ) {
        $this->timezone = $timezone;
        parent::__construct($context, $uiComponentFactory, $components, $data);
    }

   /**
    * @param array $dataSource
    *
    * @return array
    */
   public function prepareDataSource(array $dataSource) {
       if (isset($dataSource['data']['items'])) {
           foreach ($dataSource['data']['items'] as &$item) {
               $item[$this->getData('name')] = $this->prepareItem($item);
           }
       }

       return $dataSource;
   }

    protected function prepareItem(array $item) {
        $content = '';
        $date = $item[$this->getData('name')];

        if (empty($date)) {
            return '';
        }

        $content .= date_format(date_create($date), 'd M Y');

        return $content;
    }
}