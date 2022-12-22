<?php

namespace CoWell\BasicTraining\Controller\Adminhtml\Training;

use CoWell\BasicTraining\Model\ResourceModel\Student\CollectionFactory;
use CoWell\BasicTraining\Model\StudentFactory;
use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\Controller\ResultFactory;
use Magento\Ui\Component\MassAction\Filter;

class MassDelete extends Action
{
    protected StudentFactory $studentFactory;
    protected Filter $filter;
    protected CollectionFactory $collectionFactory;

    public function __construct(
        Context $context,
        StudentFactory $studentFactory,
        Filter $filter,
        CollectionFactory $collectionFactory
    ) {
        parent::__construct($context);
        $this->studentFactory = $studentFactory;
        $this->filter = $filter;
        $this->collectionFactory = $collectionFactory;
    }

    public function execute()
    {
        try {
            $collection = $this->filter->getCollection($this->collectionFactory->create());

            $count = 0;
            foreach ($collection as $item) {
                $model = $this->studentFactory->create()->load($item->getEntityId());
                $model->delete();
                $count++;
            }
            $this->messageManager->addSuccessMessage(__('A total of %1 student(s) have been deleted.', $count));
        } catch (\Exception $e) {
            $this->messageManager->addErrorMessage(__($e->getMessage()));
        }

        return $this->resultFactory->create(ResultFactory::TYPE_REDIRECT)->setPath('*/*/index');
    }
}
