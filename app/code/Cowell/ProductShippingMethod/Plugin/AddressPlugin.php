<?php

namespace Cowell\ProductShippingMethod\Plugin;

class AddressPlugin
{
    protected $cart;
    public function __construct(\Magento\Checkout\Model\Cart $cart)
    {
        $this->cart = $cart;
    }

    public function afterGetGroupedAllShippingRates(\Magento\Quote\Model\Quote\Address $subject, $result){
        $items = $this->cart->getQuote()->getAllItems();
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
