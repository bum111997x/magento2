<?php

namespace CoWell\BasicTraining\Model;

use Magento\Ui\DataProvider\AbstractDataProvider;
use CoWell\BasicTraining\Model\ResourceModel\Student\CollectionFactory;
use Magento\Framework\App\Request\DataPersistorInterface;
use Magento\Store\Model\StoreManagerInterface;

class DataProvider extends AbstractDataProvider
{
    protected $dataPersistor;

    protected $collection;

    protected $loadedData;

    protected $storeManager;

    /**
     * Constructor
     *
     * @param string $name
     * @param string $primaryFieldName
     * @param string $requestFieldName
     * @param CollectionFactory $collectionFactory
     * @param DataPersistorInterface $dataPersistor
     * @param array $meta
     * @param array $data
     */
    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        CollectionFactory $collectionFactory,
        DataPersistorInterface $dataPersistor,
        StoreManagerInterface $storeManager,
        array $meta = [],
        array $data = []
    ) {
        $this->collection = $collectionFactory->create();
        $this->dataPersistor = $dataPersistor;
        $this->storeManager = $storeManager;
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
    }

    /**
     * Get data
     *
     * @return array
     */
    public function getData()
    {
        if (isset($this->loadedData)) {
            return $this->loadedData;
        }
        $items = $this->collection->getItems();
        foreach ($items as $model) {
            $this->loadedData[$model->getId()] = $model->getData();
//            if ($model->getImg()) {
//                $m[0]['name'] = $model->getImg();
//                $m[0]['url'] = $this->getMediaUrl().$model->getImg();
//                $this->loadedData[$model->getId()]['post']['featured_image'] = $m;
//            }
            if ($model->getImg()) {
                $m['img'][0]['name'] = $model->getImg();
                $m['img'][0]['url'] = $this->getMediaUrl().$model->getImg();
                $fullData = $this->loadedData;
                $this->loadedData[$model->getId()] = array_merge($fullData[$model->getId()], $m);
            }
        }
        $data = $this->dataPersistor->get('gec_training_training');

        if (!empty($data)) {
            $model = $this->collection->getNewEmptyItem();
            $model->setData($data);
            $this->loadedData[$model->getId()] = $model->getData();
            $this->dataPersistor->clear('gec_training_training');
        }

        return $this->loadedData;
    }

    public function getMediaUrl()
    {
        $mediaUrl = $this->storeManager->getStore()
                ->getBaseUrl(\Magento\Framework\UrlInterface::URL_TYPE_MEDIA).'faq/tmp/icon/';
        return $mediaUrl;
    }
}
