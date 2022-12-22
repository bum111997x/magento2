<?php

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
    protected function _construct()
    {
        $this->_init(
            \CoWell\BasicTraining\Model\Training::class,
            \CoWell\BasicTraining\Model\ResourceModel\Training::class
        );
    }
}
