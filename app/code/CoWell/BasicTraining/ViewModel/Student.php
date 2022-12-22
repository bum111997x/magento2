<?php

namespace CoWell\BasicTraining\ViewModel;

use Magento\Framework\Api\SortOrderBuilder;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\View\Element\Block\ArgumentInterface;

class Student implements ArgumentInterface
{
    private RequestInterface $request;
    protected \CoWell\BasicTraining\Api\Data\StudentSearchResultsInterfaceFactory $studentSearchCriteriaBuilder;
    protected \CoWell\BasicTraining\Api\StudentRepositoryInterface $studentRepository;
    protected SortOrderBuilder $sortOrderBuilder;
    protected \Magento\Framework\Api\SearchCriteriaBuilder $searchCriteriaBuilder;


    public function __construct(
        RequestInterface $request,
        \Magento\Framework\Api\SearchCriteriaBuilder $searchCriteriaBuilder,
        \CoWell\BasicTraining\Api\StudentRepositoryInterface $studentRepository,
        \CoWell\BasicTraining\Api\Data\StudentSearchResultsInterfaceFactory $studentSearchCriteriaBuilder,
        sortOrderBuilder $sortOrderBuilder
    ) {
        $this->request = $request;
        $this->studentRepository = $studentRepository;
        $this->studentSearchCriteriaBuilder = $studentSearchCriteriaBuilder;
        $this->sortOrderBuilder = $sortOrderBuilder;
        $this->searchCriteriaBuilder = $searchCriteriaBuilder;
    }

    public function getCollection()
    {
        $entity_id = $this->request->getParam('entity_id');
        $name = $this->request->getParam('name');
        $gender = $this->request->getParam('gender');
        $sort = $this->request->getParam('sort');

        $yearNow = date("Y");
        $month = date("m");
        $day = date("d");
        $age = $this->request->getParam('age');
        $year = $yearNow - $age;
        $dob = $year . '-' . $month . '-' . $day;

        $studentSearchCriteria = $this->searchCriteriaBuilder->create();

        if ($entity_id != null) {
            $studentSearchCriteria = $this->searchCriteriaBuilder
                ->addFilter('entity_id', $entity_id, 'eq')->create();
        }
        if ($name != null) {
            $studentSearchCriteria = $this->searchCriteriaBuilder
                ->addFilter('name', '%' . $name . '%', 'like')->create();
        }
        if ($gender != null) {
            $studentSearchCriteria = $this->searchCriteriaBuilder
                ->addFilter('gender', $gender, 'eq')->create();
        }

        switch ($sort) {
            case 'id_ASC':
                $sortOrder = $this->sortOrderBuilder
                    ->setField('entity_id')
                    ->setDirection('ASC')
                    ->create();
                break;
            case 'id_DES':
                $sortOrder = $this->sortOrderBuilder
                    ->setField('entity_id')
                    ->setDirection('DESC')
                    ->create();
                break;
            case 'name_ASC':
                $sortOrder = $this->sortOrderBuilder
                    ->setField('name')
                    ->setDirection('ASC')
                    ->create();
                break;
            case 'name_DES':
                $sortOrder = $this->sortOrderBuilder
                    ->setField('name')
                    ->setDirection('DESC')
                    ->create();
                break;
            case 'dob_ASC':
                $sortOrder = $this->sortOrderBuilder
                    ->setField('dob')
                    ->setDirection('ASC')
                    ->create();
                break;
            case 'dob_DES':
                $sortOrder = $this->sortOrderBuilder
                    ->setField('dob')
                    ->setDirection('DESC')
                    ->create();
                break;
            default:
                $sortOrder = $this->sortOrderBuilder
                    ->setField('id')
                    ->setDirection('ASC')
                    ->create();
        }

        $studentSearchCriteria->setSortOrders([$sortOrder]);

        $student = $this->studentRepository->getList($studentSearchCriteria)->getItems();

        return $student;
    }
}
