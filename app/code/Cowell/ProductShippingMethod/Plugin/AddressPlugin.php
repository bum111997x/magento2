<?php

namespace Cowell\ProductShippingMethod\Plugin;

class AddressPlugin
{
    public function afterGetGroupedAllShippingRates(\Magento\Quote\Model\Quote\Address $subject, $result){
        $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
        $cart = $objectManager->get('\Magento\Checkout\Model\Cart');

        $items = $cart->getQuote()->getAllItems();
        $array = [];

        foreach ($items as $item){
            if ($item->getProduct()->getShippingMe()){
                $array[] = explode(',', $item->getProduct()->getShippingMe());
            }else{
                $array[] = [];
            }
        }

        $newResult = array_intersect(...$array);

        foreach ($result as $key => $value) {
            if (!in_array($value[0]->getCode(), $newResult)){
                unset($result[$key]);
            }
        }
        return $result;
    }
}
