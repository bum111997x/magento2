<?php

namespace CoWell\BasicTraining\Observer;

use CoWell\BasicTraining\Logger\Logger;
use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;

class MyObserver implements ObserverInterface
{
    protected Logger $logger;

    public function __construct(
        Logger $logger
    ) {
        $this->logger = $logger;
    }

    public function execute(Observer $observer)
    {
        $myEventData = $observer->getData('product');
        $this->logger->info('Create Product suggess ' . $myEventData->getData()['sku']);
    }
}
