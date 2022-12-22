<?php

namespace CoWell\BasicTraining\Model\ResourceModel\Student;

use CoWell\BasicTraining\Model\Student;
use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
    protected function _construct()
    {
        $this->_init(Student::class, \CoWell\BasicTraining\Model\ResourceModel\Student::class);
    }
}
