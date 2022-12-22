<?php

namespace CoWell\BasicTraining\Api;

use Magento\Framework\Api\SearchCriteriaInterface;

interface StudentRepositoryInterface
{
    /**
     * @return mixed
     */
    public function create();

    /**
     * @param $studentId
     * @return mixed
     */
    public function update();

    /**
     * Retrieve Student
     * @param string $entityId
     * @return \CoWell\BasicTraining\Api\Data\StudentInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function get($entityId);

    /**
     * Retrieve Student matching the specified criteria.
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
     * @return \CoWell\BasicTraining\Api\Data\StudentSearchResultsInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getList(
        \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
    );

    /**
     * Delete Student
     * @param \CoWell\BasicTraining\Api\Data\StudentInterface $student
     * @return bool true on success
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function delete(
        \CoWell\BasicTraining\Api\Data\StudentInterface $student
    );

    /**
     * Delete Student by ID
     * @param string $studentId
     * @return bool true on success
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function deleteById($studentId);
}
