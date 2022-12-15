<?php

namespace Cowell\ProductShippingMethod\Plugin;

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
                $result->getExtensionAttributes()->setPaymentFee($item->getData('payment_fee'));
        }
        return $result;
    }
}
