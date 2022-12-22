<?php
namespace CoWell\BasicTraining\Model\ResourceModel;

class Training extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    public function __construct(
        \Magento\Framework\Model\ResourceModel\Db\Context $context
    ) {
        parent::__construct($context);
    }

    protected function _construct()
    {
        $this->_init('cowell_basictraining_training', 'training_id');
    }
}
