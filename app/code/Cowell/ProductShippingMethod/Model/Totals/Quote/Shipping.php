<?php

namespace Cowell\ProductShippingMethod\Model\Totals\Quote;

class Shipping extends \Magento\Quote\Model\Quote\Address\Total\AbstractTotal
{
    /**
     * @var \Magento\Framework\Pricing\PriceCurrencyInterface
     */
    protected $_priceCurrency;
    /**
     * Custom constructor.
     * @param \Magento\Framework\Pricing\PriceCurrencyInterface $priceCurrency
     */
    public function __construct(
        \Magento\Framework\Pricing\PriceCurrencyInterface $priceCurrency
    ) {
        $this->_priceCurrency = $priceCurrency;
    }
    /**
     * @param \Magento\Quote\Model\Quote $quote
     * @param \Magento\Quote\Api\Data\ShippingAssignmentInterface $shippingAssignment
     * @param \Magento\Quote\Model\Quote\Address\Total $total
     * @return $this|bool
     */
    public function collect(
        \Magento\Quote\Model\Quote $quote,
        \Magento\Quote\Api\Data\ShippingAssignmentInterface $shippingAssignment,
        \Magento\Quote\Model\Quote\Address\Total $total
    ) {
        parent::collect($quote, $shippingAssignment, $total);
        $products = $quote->getItems();
        $shipping_fee = 0;
        if ($products) {
            foreach ($products as $product) {
                if ($product->getPaymentFee()) {
                    $shipping_fee += $product->getPaymentFee();
                }
            }
        }
        $shipping = $this->_priceCurrency->convert($shipping_fee);

        $total->addTotalAmount($this->getCode(), +$shipping);
        $total->addBaseTotalAmount($this->getCode(), +$shipping);
        $total->setBaseGrandTotal($total->getBaseGrandTotal() +$shipping);
        $quote->setCustomDiscount(+$shipping);

        return $this;
    }

    public function fetch(
        \Magento\Quote\Model\Quote $quote,
        \Magento\Quote\Model\Quote\Address\Total $total
    ) {
        $products = $quote->getItems();
        $shipping_fee = 0;
        if ($products) {
            foreach ($products as $product) {
                if ($product->getPaymentFee()) {
                    $shipping_fee += $product->getPaymentFee();
                }
            }
        }

        $shipping = $this->_priceCurrency->convert($shipping_fee);
        return [
            'code' => $this->getCode(),
            'title' => "Payment Fee",
            'value' => + $shipping  //You can change the reduced amount, or replace it with your own variable
        ];
    }
}
