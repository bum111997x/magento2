<?php

namespace CoWell\BasicTraining\Controller\Adminhtml\Training;

use CoWell\BasicTraining\Model\ResourceModel\Student\CollectionFactory;
use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Framework\App\Action\HttpPostActionInterface as HttpPostActionInterface;
use Magento\Store\Model\StoreManagerInterface;

class Validate extends Action implements HttpPostActionInterface, HttpGetActionInterface
{
    protected \Magento\Framework\Controller\Result\JsonFactory $resultJsonFactory;
    protected CollectionFactory $collectionFactory;


    public function __construct(
        Context                                          $context,
        \Magento\Framework\Controller\Result\JsonFactory $resultJsonFactory,
        CollectionFactory                                $collectionFactory,
    )
    {
        parent::__construct($context);
        $this->resultJsonFactory = $resultJsonFactory;
        $this->collectionFactory = $collectionFactory;
    }

    public function execute()
    {
        $data = $this->getRequest()->getPostValue();
        $id = $this->getRequest()->getParam('entity_id');
        $name = $data['name'];
        $resultJson = $this->resultJsonFactory->create();
        $response = new \Magento\Framework\DataObject();
        if ($name && !$id) {
            $collection = $this->collectionFactory->create()->addFieldToFilter('name', $name);
            $response = new \Magento\Framework\DataObject();
            if ($collection->getSize() > 0) {
                $response->setError(true);
                $response->setMessages(['Tên đã tồn tại']);
                return $resultJson->setData($response);
            }
        }
        return $resultJson->setData($response);
    }

}

