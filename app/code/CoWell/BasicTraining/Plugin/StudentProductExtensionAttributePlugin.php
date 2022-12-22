<?php

namespace CoWell\BasicTraining\Plugin;

use CoWell\BasicTraining\Api\Data\StudentInterface;
use CoWell\BasicTraining\Api\StudentRepositoryInterface;
use Magento\Catalog\Api\Data\ProductInterfaceFactory;
use CoWell\BasicTraining\Model\ResourceModel\Student as ResourceStudent;

class StudentProductExtensionAttributePlugin
{
    protected $productRepository;
    protected $resource;

    public function __construct(
        \Magento\Catalog\Api\ProductRepositoryInterface $productRepository,
        ResourceStudent                                 $resource
    ) {
        $this->productRepository = $productRepository;
        $this->resource = $resource;
    }

    public function afterGet(StudentRepositoryInterface $subject, StudentInterface $result)
    {
        $connection = $this->resource->getConnection();
        $select = $connection->select()->from(['catalog_product_students'])
            ->where('student_id=' . $result->getData()['entity_id']);
        $array = $connection->fetchAll($select);
        $productIds = [];
        foreach ($array as $key => $item) {
                $productIds[] = $item['product_id'];
        }
        $products = [];
        foreach ($productIds as $id) {
            $products[] = $this->productRepository->getById($id);
        }
        $studentExtension = $result->getExtensionAttributes();
        $studentExtension->setProductInfo($products);
        if ($products) {
            $result->setExtensionAttributes($studentExtension);
        }
        return $result;
    }
}
