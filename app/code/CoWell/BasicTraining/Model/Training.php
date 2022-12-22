<?php

namespace CoWell\BasicTraining\Model;

class Training extends \Magento\Framework\Model\AbstractModel implements \Magento\Framework\DataObject\IdentityInterface
{
    const CACHE_TAG = 'coWell_basicTraining_training';

    protected $_cacheTag = 'coWell_basicTraining_training';

    protected $_eventPrefix = 'coWell_basicTraining_training';

    protected function _construct()
    {
        $this->_init('CoWell\BasicTraining\Model\ResourceModel\Training');
    }

    public function getIdentities()
    {
        return [self::CACHE_TAG . '_' . $this->getId()];
    }

    public function getDefaultValues()
    {
        $values = [];

        return $values;
    }
}
