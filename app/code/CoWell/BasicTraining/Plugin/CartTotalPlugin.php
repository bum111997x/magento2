<?php

namespace CoWell\BasicTraining\Plugin;

use Magento\Quote\Model\Quote;

class CartTotalPlugin
{
    protected $_checkoutSession;


    public function __construct(\Magento\Checkout\Model\Session $checkoutSession,)
    {
        $this->_checkoutSession = $checkoutSession;
    }

    public function afterModelToDataObject($subject, $result)
    {
        $items = $this->_checkoutSession->getQuote()->getItems();
        foreach ($items as $item) {
            if ($item->getItemId() == $result->getItemId())
                $result->getExtensionAttributes()->setShippingFee($item->getData('shipping_fee'));
        }
        return $result;
    }
}
