<?php

namespace CoWell\BasicTraining\Controller\Adminhtml\Training;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\Controller\ResultFactory;

class Form extends Action
{
    public function __construct(Context $context)
    {
        parent::__construct($context);
    }

    public function execute()
    {
        $resultPage = $this->resultFactory->create(ResultFactory::TYPE_PAGE);

        $param = $this->getRequest()->getParam('entity_id');

        if ($param) {
            $resultPage->getConfig()->getTitle()->prepend((__('Edit Student')));
        } else {
            $resultPage->getConfig()->getTitle()->prepend((__('Create Student')));
        }

        return $resultPage;
    }
}
