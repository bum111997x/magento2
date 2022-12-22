<?php

namespace CoWell\BasicTraining\Plugin;

class AddressPlugin
{
//    public function afterGetGroupedAllShippingRates(\Magento\Quote\Model\Quote\Address $subject, $result)
//    {
//        $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
//        $cart = $objectManager->get('\Magento\Checkout\Model\Cart');
//
//        $items = $cart->getQuote()->getAllItems();
//
//        $array = [];
//        if ($items != null) {
//            foreach ($items as $item) {
//                $array[] = explode(',', $item->getProduct()->getShippingMethods());
//            }
//            $newResult = array_intersect(...$array);
//
//            foreach ($result as $key => $value) {
//                if (!in_array($value[0]->getData()['code'], $newResult)) {
//                    unset($result[$key]);
//                }
//            }
//        }

//
//        return $result;
//    }
}
