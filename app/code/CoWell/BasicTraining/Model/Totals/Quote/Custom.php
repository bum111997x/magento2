<?php

namespace CoWell\BasicTraining\Model\Totals\Quote;

/**
 * Class Custom
 * @package Mageplaza\HelloWorld\Model\Total\Quote
 */
class Custom extends \Magento\Quote\Model\Quote\Address\Total\AbstractTotal
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
        $baseDiscount = $total->getData()['subtotal']*10/100;
        $discount =  $this->_priceCurrency->convert($baseDiscount);

        $total->addTotalAmount($this->getCode(), -$discount);
        $total->addBaseTotalAmount($this->getCode(), -$discount);
        $total->setBaseGrandTotal($total->getBaseGrandTotal() - $discount);
        $quote->setCustomDiscount(-$discount);

        return $this;
    }

    public function fetch(
        \Magento\Quote\Model\Quote $quote,
        \Magento\Quote\Model\Quote\Address\Total $total
    ) {
        $baseDiscount = $total->getData()['subtotal']*10/100;
        $discount =  $this->_priceCurrency->convert($baseDiscount);

        return [
            'code' => $this->getCode(),
            'title' => "AAAAAAAAAAAAAAAA",
            'value' => - $discount  //You can change the reduced amount, or replace it with your own variable
        ];
    }
}
