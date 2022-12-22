<?php

namespace CoWell\BasicTraining\Observer;

use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;
use Magento\Framework\App\RequestFactory;
use CoWell\BasicTraining\Model\ResourceModel\Student;

class SaveStudentToProduct implements ObserverInterface
{
    protected $requestFactory;
    protected $studentResoureceModel;

    public function __construct(
        RequestFactory $requestFactory,
        Student $studentResoureceModel
    ) {
        $this->requestFactory = $requestFactory;
        $this->studentResoureceModel = $studentResoureceModel;
    }

    public function execute(Observer $observer)
    {
        if (isset($this->requestFactory->create()->getParams()['links']['relatedstudent'])) {
            $students= $this->requestFactory->create()->getParams()['links']['relatedstudent'];
            $productId = $observer->getEvent()->getProduct()->getEntityId();
            $this->studentResoureceModel->saveRelatedStudent($students, $productId);

            return $observer;
        }
        return $observer;
    }
}
