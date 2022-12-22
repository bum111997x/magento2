<?php

namespace Cowell\ProductShippingMethod\Helper;

class ShippingMethods
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

    public function get($result){
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

        $arrays = explode(',', $result);
        $shipping_titles = "";

        foreach ($this->_options as $option){
            if (in_array($option['value'][0]['value'], $arrays)){
                $shipping_titles .= $option['label']."<br>" ;
            }
        }

        return $shipping_titles;
    }
}
