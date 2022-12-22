<?php

namespace CoWell\BasicTraining\Api\Data;

interface StudentSearchResultsInterface extends \Magento\Framework\Api\SearchResultsInterface
{
    /**
     * Get Student list.
     * @return \CoWell\BasicTraining\Api\Data\StudentInterface[]
     */
    public function getItems();

    /**
     * Set name list.
     * @param \CoWell\BasicTraining\Api\Data\StudentInterface[] $items
     * @return $this
     */
    public function setItems(array $items);
}
