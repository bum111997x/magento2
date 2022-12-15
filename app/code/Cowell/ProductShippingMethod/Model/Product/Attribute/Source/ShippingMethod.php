<?php

namespace Cowell\ProductShippingMethod\Model\Product\Attribute\Source;

class ShippingMethod extends \Magento\Eav\Model\Entity\Attribute\Source\AbstractSource
{
    protected $scopeConfig;
    protected $shipconfig;

    public function __construct(
        \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig,
        \Magento\Shipping\Model\Config $shipconfig
    ) {
        $this->shipconfig = $shipconfig;
        $this->scopeConfig = $scopeConfig;
    }

    public function getAllOptions()
    {
        $activeCarriers = $this->shipconfig->getActiveCarriers();

        foreach ($activeCarriers as $carrierCode => $carrierModel) {
            $options = array();

            if ($carrierMethods = $carrierModel->getAllowedMethods()) {
                foreach ($carrierMethods as $methodCode => $method) {
                    $code = $carrierCode . '_' . $methodCode;
                    $options[] = array('value' => $code, 'label' => $method);
                }
                $carrierTitle = $this->scopeConfig
                    ->getValue('carriers/'.$carrierCode.'/title');
            }

            $methods[] = array('value' => $options, 'label' => $carrierTitle);
        }

        $this->_options = $methods;

        return $this->_options;
    }
}
