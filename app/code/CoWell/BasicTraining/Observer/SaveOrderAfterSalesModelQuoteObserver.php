<?php

namespace CoWell\BasicTraining\Observer;

use Magento\Framework\DataObject\Copy;
use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;
use Magento\Sales\Model\Order;

class SaveOrderAfterSalesModelQuoteObserver implements ObserverInterface
{

    /**
     * @var \Cowell\BasicTraining\Model\ResourceModel\Student
     */
    protected $resource;
    protected $objectCopyService;


    /**
     * @param \Cowell\BasicTraining\Model\ResourceModel\Student $resource
     * @param Copy $objectCopyService
     */
    public function __construct(
        \CoWell\BasicTraining\Model\ResourceModel\Student $resource,
        Copy $objectCopyService,
    ) {
        $this->objectCopyService = $objectCopyService;
        $this->resource = $resource;
    }

    /**
     * @param Observer $observer
     * @return $this|void
     */
    public function execute(Observer $observer)
    {
        /* @var Order $order */
        $order = $observer->getEvent()->getData('order');
        $connection = $this->resource->getConnection();
        $select = $connection->insert('sales_order_shipping_fee', [
            'sales_order_id'=>$order->getId(),
            'sample_attribute_2'=>$order->getSampleAttribute(),]);
        return $this;
    }
}
