<?php

namespace CoWell\BasicTraining\Observer;

use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;

class SetItemCustomAttribute implements ObserverInterface
{

    public function execute(Observer $observer)
    {
        $quoteItem = $observer->getQuoteItem();
        $product = $observer->getProduct();
        $quoteItem->setShippingFee($product->getShippingFee());
    }
}
