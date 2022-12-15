<?php

namespace Cowell\ProductShippingMethod\Block\Sales\Order;

class PaymentFee extends \Magento\Framework\View\Element\Template
{
    /**
     * @var Order
     */
    protected $_order;
    /**
     * @var \Magento\Framework\DataObject
     */
    protected $_source;
    /**
     * @param \Magento\Framework\View\Element\Template\Context $context
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        array $data = []
    ) {
        parent::__construct($context, $data);
    }
    public function getSource()
    {
        return $this->_source;
    }
    public function displayFullSummary()
    {
        return true;
    }
    public function initTotals()
    {
        $parent = $this->getParentBlock();
        $this->_order = $parent->getOrder();
        $this->_source = $parent->getSource();
        $title = 'Payment Fee Total';
        $store = $this->getStore();
        $paymentFee = 0;
        foreach ($this->_order->getItems() as $item){
            if ($item->getPaymentFee() != null){
                $paymentFee += $item->getPaymentFee();
            }
        }

        if($paymentFee){
            $customAmount = new \Magento\Framework\DataObject(
                [
                    'code' => 'payment_fee',
                    'strong' => false,
                    'value' => $paymentFee,
                    'label' => __($title),
                ]
            );
            $parent->addTotal($customAmount, 'payment_fee');
        }
        return $this;
    }
    /**
     * Get order store object
     *
     * @return \Magento\Store\Model\Store
     */
    public function getStore()
    {
        return $this->_order->getStore();
    }
    /**
     * @return Order
     */
    public function getOrder()
    {
        return $this->_order;
    }
    /**
     * @return array
     */
    public function getLabelProperties()
    {
        return $this->getParentBlock()->getLabelProperties();
    }
    /**
     * @return array
     */
    public function getValueProperties()
    {
        return $this->getParentBlock()->getValueProperties();
    }
}
