<?php

namespace CoWell\BasicTraining\Api\Data;

interface StudentInterface extends \Magento\Framework\Api\ExtensibleDataInterface
{
    const NAME = 'name';
    const ENTITY_ID = 'entity_id';
    const GENDER = 'gender';
    const DOB = 'dob';
    const ADDRESS = 'address';
    const IMG = 'img';

    /**
     * Get student_id
     * @return string|null
     */
    public function getEntityId();

    /**
     * @param $entityId
     * @return mixed
     */
    public function setEntityId($entityId);

    /**
     * Get name
     * @return string|null
     */
    public function getName();

    /**
     * Set name
     * @param string $name
     * @return StudentInterface
     */
    public function setName($name);

    /**
     * @return mixed
     */
    public function getGender();

    /**
     * @param $gender
     * @return StudentInterface
     */
    public function setGender($gender);

    /**
     * @return mixed
     */
    public function getDob();

    /**
     * @param $dob
     * @return StudentInterface
     */
    public function setDob($dob);

    /**
     * @return mixed
     */
    public function getAddress();

    /**
     * @param $address
     * @return StudentInterface
     */
    public function setAddress($address);

    /**
     * @return mixed
     */
    public function getImg();

    /**
     * @param $img
     * @return StudentInterface
     */
    public function setImg($img);

    /**
     * Retrieve existing extension attributes object or create a new one.
     *
     * @return \CoWell\BasicTraining\Api\Data\StudentExtensionInterface|null
     */
    public function getExtensionAttributes();

    /**
     * Set an extension attributes object.
     *
     * @param \CoWell\BasicTraining\Api\Data\StudentExtensionInterface $extensionAttributes
     * @return $this
     */
    public function setExtensionAttributes(
        \CoWell\BasicTraining\Api\Data\StudentExtensionInterface $extensionAttributes
    );

}
