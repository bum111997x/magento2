<?php

namespace CoWell\BasicTraining\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;
use Magento\Framework\Model\ResourceModel\Db\Context;

class Student extends AbstractDb
{

    public function __construct(Context $context)
    {
        parent::__construct($context);
    }

    protected function _construct()
    {
        $this->_init('students', 'entity_id');
    }

    public function saveRelatedStudent($students, $productId)
    {

        $connection = $this->getConnection();
        $result = $connection->select()
            ->from('catalog_product_students')
            ->where('product_id = ?', $productId);
        $product = $connection->fetchAll($result);
        if ($product) {
            $connection->delete('catalog_product_students', ['product_id = ?' => $productId]);
        }

        foreach ($students as $student) {
            $data = [
                'product_id' => $productId,
                'student_id' => $student['id']
            ];

            $connection->insert('catalog_product_students', $data);
        }
    }

    public function getListRelatedStudent($productId)
    {
        $connection = $this->getConnection();
        $result = $connection->select()
            ->from(['tb1' => 'catalog_product_students'], )
            ->where('product_id = ?', $productId)
            ->join(['tb2' => 'students'] , 'tb1.student_id = tb2.entity_id');
        ;
        $students = $connection->fetchAll($result);

        return $students;
    }
}
