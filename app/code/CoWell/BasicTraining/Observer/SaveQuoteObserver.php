<?php

namespace CoWell\BasicTraining\Observer;

use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;

class SaveQuoteObserver implements ObserverInterface
{
    protected $total;

    public function __construct(
        \Magento\Quote\Model\Quote\Address\Total $total
    ) {
        $this->total = $total;
    }

    public function execute(Observer $observer)
    {
        $observer->getCart()->getQuote()->setSampleAttribute(5);

        return $observer;
    }
}
