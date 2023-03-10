<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Cowell\Region\Controller\Adminhtml\Region;

use Cowell\Region\Model\ResourceModel\Region;
use Magento\Framework\Exception\LocalizedException;

class Save extends \Magento\Backend\App\Action
{
    protected $dataPersistor;
    protected $regionResource;

    /**
     * @param \Magento\Backend\App\Action\Context $context
     * @param \Magento\Framework\App\Request\DataPersistorInterface $dataPersistor
     * @param \Cowell\Region\Model\ResourceModel\Region $region
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\App\Request\DataPersistorInterface $dataPersistor,
        Region $regionResource
    ) {
        parent::__construct($context);
        $this->dataPersistor = $dataPersistor;
        $this->regionResource = $regionResource;
    }

    /**
     * Save action
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();
        $data = $this->getRequest()->getPostValue();
        if ($data) {
            $id = $this->getRequest()->getParam('region_id') ? $this->getRequest()->getParam('region_id') : null;
            $locale = $data['Sample'] ?  $data['Sample']  : null;

            $model = $this->_objectManager->create(\Cowell\Region\Model\Region::class)->load($id);

            if (!$model->getId() && $id) {
                $this->messageManager->addErrorMessage(__('This Region no longer exists.'));
                return $resultRedirect->setPath('*/*/');
            }

            $model->setData($data);

            try {
                $model->save();
                $this->regionResource->saveLocaleName($locale, $model->getId(), $id );
                $this->messageManager->addSuccessMessage(__('You saved the Region.'));
                $this->dataPersistor->clear('cowell_region_region');

                if ($this->getRequest()->getParam('back')) {
                    return $resultRedirect->setPath('*/*/edit', ['region_id' => $model->getId()]);
                }
                return $resultRedirect->setPath('*/*/');
            } catch (LocalizedException $e) {
                $this->messageManager->addErrorMessage($e->getMessage());
            } catch (\Exception $e) {
                $this->messageManager->addExceptionMessage($e, __('Something went wrong while saving the Region.'));
            }

            $this->dataPersistor->set('cowell_region_region', $data);
            return $resultRedirect->setPath('*/*/edit', ['region_id' => $this->getRequest()->getParam('region_id')]);
        }
        return $resultRedirect->setPath('*/*/');
    }
}
