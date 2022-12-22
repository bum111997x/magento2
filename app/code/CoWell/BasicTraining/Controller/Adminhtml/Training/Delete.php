<?php

namespace CoWell\BasicTraining\Controller\Adminhtml\Training;

use CoWell\BasicTraining\Model\StudentFactory;
use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;

class Delete extends Action
{
    protected $studentFactory;
    protected $_file;

    public function __construct(
        Context $context,
        StudentFactory $studentFactory,
        \Magento\Framework\Filesystem\Driver\File $file
    ) {
        parent::__construct($context);
        $this->studentFactory = $studentFactory;
        $this->_file = $file;
    }

    public function execute()
    {
        /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();

        $id = $this->getRequest()->getParam('entity_id');

        try {
            $studentModel = $this->studentFactory->create();
            $studentModel->load($id);
            $fileName = $studentModel->getImg();
            $mediaDirectory = $this->_objectManager->get('Magento\Framework\Filesystem')
                ->getDirectoryRead(\Magento\Framework\App\Filesystem\DirectoryList::MEDIA);
            $mediaRootDir = $mediaDirectory->getAbsolutePath();

            $studentModel->delete();

            if ($this->_file->isExists($mediaRootDir . 'faq/tmp/icon/' . $fileName)) {
                $this->_file->deleteFile($mediaRootDir . 'faq/tmp/icon/' . $fileName);
            }

            $this->messageManager->addSuccessMessage(__('You deleted the student.'));
        } catch (\Exception $e) {
            $this->messageManager->addErrorMessage($e->getMessage());
        }

        return $resultRedirect->setPath('*/*/');
    }
}
