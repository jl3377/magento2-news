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
 * @category   Ilovemarketing_News
 * @package    NewsConfig.php - Helper to get the configuration from news.
 * @author     José Luis Rojo Sánchez <jose@artegrafico.net>
 * @copyright  Copyright (c) artegrafico.net (https://www.artegrafico.net/)
 * @license    http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 * @version    0.0.1
 *
 */

namespace Ilovemarketing\News\Helper;

use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Store\Model\ScopeInterface;

class NewsConfig extends AbstractHelper {
    
    public function getConfig($path, $store = null) {
        
        return $this->scopeConfig->getValue(
            $path, 
            ScopeInterface::SCOPE_STORE,
            $store
        );
        
    }
    
    public function getSerializedConfigValue($configPath, $store = null) {
        
        $value = $this->getConfigValue($configPath, $store);
 
        if (empty($value)) return false;
 
        if ($this->isSerialized($value)) {
            $unserializer = ObjectManager::getInstance()->get(\Magento\Framework\Unserialize\Unserialize::class);
        } else {
            $unserializer = ObjectManager::getInstance()->get(\Magento\Framework\Serialize\Serializer\Json::class);
        }
 
        return $unserializer->unserialize($value);
    }    
    
    private function isSerialized($value) {
        return (boolean) preg_match('/^((s|i|d|b|a|O|C):|N;)/', $value);
    }    
    
    /*public function isEnabled() {
        return $this->getConfig('news/enabled');
    }
 
    public function convertText($text){
        return strtoupper($text);
    } */
    
}