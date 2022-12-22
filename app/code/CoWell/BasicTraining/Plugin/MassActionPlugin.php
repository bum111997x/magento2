<?php

namespace CoWell\BasicTraining\Plugin;

class MassActionPlugin
{
    public $scopeConfig;

    public function __construct(
        \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig
    ) {
        $this->scopeConfig = $scopeConfig;
    }

    public function afterGetChildComponents(\Magento\Ui\Component\MassAction $subject, $result)
    {
        $valueFromConfig = $this->scopeConfig->getValue(
            'manage/general/button_activate',
        );
        $arrayButton =  explode(',', $valueFromConfig);

        foreach ($result as $key => $value) {
            if (!in_array($key, $arrayButton)) {
                unset($result[$key]);
            }
        }

        return $result;
    }
}
