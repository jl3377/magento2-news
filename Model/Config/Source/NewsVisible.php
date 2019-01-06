<?php
namespace Ilovemarketing\News\Model\Config\Source;

use Magento\Captcha\Model\Config\Form\AbstractForm;

class NewsVisible extends AbstractForm {

    protected $_configPath = 'news/visibility';

    public function toOptionArray() {

        $optionArray = [];
        $backendConfig = $this->_config->getValue($this->_configPath, 'default');
        if ($backendConfig) {
            foreach ($backendConfig as $formName => $formConfig) {
                if (!empty($formConfig['label'])) {
                    $optionArray[] = [
                        'label' => $formConfig['label'], 
                        'value' => $formName
                    ];
                }
            }
        }
        return $optionArray;

    }
}