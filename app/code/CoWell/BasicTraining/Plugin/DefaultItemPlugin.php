<?php

namespace CoWell\BasicTraining\Plugin;
use Magento\Catalog\Api\ProductManagementInterface;
use Magento\Quote\Model\Quote\Item;

class DefaultItemPlugin
{

    public function aroundGetItemData($subject, \Closure $proceed, Item $item)
    {
        $data = $proceed($item);
        $product = $item->getProduct();

        $atts = [
            "shipping_fee" => $product->getShippingFee()
        ];
        return array_merge($data, $atts);
    }
}
