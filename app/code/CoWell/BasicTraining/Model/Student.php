<?php

namespace CoWell\BasicTraining\Model;

use Cowell\BasicTraining\Api\Data\StudentExtensionInterface;
use CoWell\BasicTraining\Api\Data\StudentInterface;

class Student extends \Magento\Framework\Model\AbstractExtensibleModel implements StudentInterface
{

    protected function _construct()
    {
        $this->_init('CoWell\BasicTraining\Model\ResourceModel\Student');
        parent::_construct();
    }

    public function getEntityId()
    {
        return $this->getData(self::ENTITY_ID);
    }

    public function setEntityId($entityId)
    {
        return $this->setData(self::ENTITY_ID, $entityId);
    }

    public function getName()
    {
        return $this->getData(self::NAME);
    }

    public function setName($name)
    {
        return $this->setData(self::NAME, $name);
    }

    public function getGender()
    {
        return $this->getData(self::GENDER);
    }

    public function setGender($gender)
    {
        return $this->setData(self::GENDER, $gender);
    }

    public function getDob()
    {
        return $this->getData(self::DOB);
    }

    public function setDob($dob)
    {
        return $this->setData(self::DOB, $dob);
    }

    public function getAddress()
    {
        return $this->getData(self::ADDRESS);
    }

    public function setAddress($address)
    {
        return $this->setData(self::ADDRESS, $address);
    }

    public function getImg()
    {
        return $this->getData(self::IMG);
    }

    public function setImg($img)
    {
        return $this->setData(self::IMG, $img);
    }


    /**
     * @inheritdoc
     */
    public function getExtensionAttributes()
    {
        return $this->_getExtensionAttributes();
    }

    /**
     * {@inheritdoc}
     *
     * @param \Cowell\BasicTraining\Api\Data\StudentExtensionInterface $extensionAttributes
     * @return $this
     */
    public function setExtensionAttributes(
        \Cowell\BasicTraining\Api\Data\StudentExtensionInterface $extensionAttributes
    ) {
        return $this->_setExtensionAttributes($extensionAttributes);
    }
}
