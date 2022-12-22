<?php

namespace CoWell\BasicTraining\Controller\Adminhtml\Training;

use CoWell\BasicTraining\Model\StudentFactory;
use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\Controller\Result\JsonFactory;

class InlineEdit extends Action
{

    protected $jsonFactory;
    private $studentFactory;

    public function __construct(
        Context $context,
        JsonFactory $jsonFactory,
        StudentFactory $studentFactory)
    {
        parent::__construct($context);
        $this->jsonFactory = $jsonFactory;
        $this->studentFactory = $studentFactory;
    }

    public function execute()
    {
        $resultJson = $this->jsonFactory->create();
        $error = false;
        $messages = [];

        if ($this->getRequest()->getParam('isAjax')) {
            $postItems = $this->getRequest()->getParam('items', []);
            if (!count($postItems)) {
                $messages[] = __('Please correct the data sent.');
                $error = true;
            } else {
                foreach (array_keys($postItems) as $modelid) {
                    $model = $this->studentFactory->create()->load($modelid);
                    try {
                        $model->setData(array_merge($model->getData(), $postItems[$modelid]));
                        $model->save();
                    } catch (\Exception $e) {
                        $messages[] = "[Student ID: {$modelid}] {$e->getMessage()}";
                        $error = true;
                    }
                }
            }
        }


        return $resultJson->setData([
            'messages' => $messages,
            'error' => $error]);
    }
}
