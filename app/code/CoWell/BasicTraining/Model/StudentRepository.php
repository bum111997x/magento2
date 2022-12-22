<?php

namespace CoWell\BasicTraining\Model;

use CoWell\BasicTraining\Api\Data\StudentInterface;
use CoWell\BasicTraining\Api\StudentRepositoryInterface;
use CoWell\BasicTraining\Api\Data\StudentInterfaceFactory;
use CoWell\BasicTraining\Api\Data\StudentSearchResultsInterfaceFactory;
use CoWell\BasicTraining\Model\ResourceModel\Student as ResourceStudent;
use CoWell\BasicTraining\Model\ResourceModel\Student\CollectionFactory as StudentCollectionFactory;
use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;
use Magento\Framework\App\RequestFactory;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\NoSuchEntityException;

class StudentRepository implements StudentRepositoryInterface
{
    /**
     * @var ResourceStudent
     */
    protected $resource;

    /**
     * @var StudentInterfaceFactory
     */
    protected $studentFactory;

    /**
     * @var StudentCollectionFactory
     */
    protected $studentCollectionFactory;

    /**
     * @var Student
     */
    protected $searchResultsFactory;

    /**
     * @var CollectionProcessorInterface
     */
    protected $collectionProcessor;

    protected $requestFactory;

    /**
     * @param ResourceStudent $resource
     * @param StudentInterfaceFactory $studentFactory
     * @param StudentCollectionFactory $studentCollectionFactory
     * @param StudentSearchResultsInterfaceFactory $searchResultsFactory
     * @param CollectionProcessorInterface $collectionProcessor
     */
    public function __construct(
        ResourceStudent                      $resource,
        StudentInterfaceFactory              $studentFactory,
        StudentCollectionFactory             $studentCollectionFactory,
        StudentSearchResultsInterfaceFactory $searchResultsFactory,
        CollectionProcessorInterface         $collectionProcessor,
        RequestFactory                       $requestFactory
    ) {
        $this->resource = $resource;
        $this->studentFactory = $studentFactory;
        $this->studentCollectionFactory = $studentCollectionFactory;
        $this->searchResultsFactory = $searchResultsFactory;
        $this->collectionProcessor = $collectionProcessor;
        $this->requestFactory = $requestFactory;
    }

    public function create()
    {
        $request = $this->requestFactory->create()->getParams();
        $student = $this->studentFactory->create();

        $student->setName($request['name']);
        $student->setAddress($request['address']);
        $student->setDob($request['dob']);
        $student->setGender($request['gender']);
        $student->setImg($request['img']);

        $this->resource->save($student);

        try {
            $this->resource->save($student);
            return [
                'success' => 200,
                'mess' => 'Create Student successfully'
            ];
        } catch (\Exception $exception) {
            throw new CouldNotDeleteException(__(
                'Could not delete Student : %1',
                $exception->getMessage()
            ));
        }
    }

    public function update()
    {
        $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
        $request = $objectManager->get('Magento\Framework\Webapi\Rest\Request')->getRequestData();

        $student = $this->studentFactory->create();
        $this->resource->load($student, $request['entity_id']);
        $student->setData($request);
        $this->resource->save($student);

        return true;
    }

    public function get($entityId)
    {
        $student = $this->studentFactory->create();
        $this->resource->load($student, $entityId);
        if (!$student->getId()) {
            throw new NoSuchEntityException(__('Student with id "%1" does not exist.', $entityId));
        }
        return $student;
    }


    public function getList(
        \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
    ) {
        $collection = $this->studentCollectionFactory->create();

        $this->collectionProcessor->process($searchCriteria, $collection);

        $searchResults = $this->searchResultsFactory->create();
        $searchResults->setSearchCriteria($searchCriteria);

        $items = [];
        foreach ($collection as $model) {
            $items[] = $model;
        }

        $product = $this->resource->getConnection();

        $select = $product->select()->from(['tb1' => 'catalog_product_entity'])
            ->join(['tb2' => 'catalog_category_product'], 'tb1.entity_id = tb2.entity_id ');

        $select1 = $product->select()->from(['tb1' => 'catalog_product_entity'], '')
            ->join(['tb2' => 'catalog_category_product'], 'tb1.entity_id = tb2.entity_id ');


        $product->fetchAll($select);

        $searchResults->setItems($items);
        $searchResults->setTotalCount($collection->getSize());


        return $searchResults;
    }

    public function delete(\CoWell\BasicTraining\Api\Data\StudentInterface $student)
    {
    }


    public function deleteById($studentId)
    {
        try {
            $student = $this->studentFactory->create();
            $this->resource->load($student, $studentId);
            $this->resource->delete($student);
        } catch (\Exception $exception) {
            throw new CouldNotDeleteException(__(
                'Could not delete Student : %1',
                $exception->getMessage()
            ));
        }
        return true;
    }
}
