<?php

namespace Cowell\ProductShippingMethod\Observer;

use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;

class SetItemCustomAttributeToQuoteItem implements ObserverInterface
{

    public function execute(Observer $observer)
    {
        $quoteItem = $observer->getQuoteItem();
        $product = $observer->getProduct();
        $quoteItem->setPaymentFee($product->getPaymentFe());
    }
}
