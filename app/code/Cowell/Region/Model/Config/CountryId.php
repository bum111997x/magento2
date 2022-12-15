<?php

namespace Cowell\Region\Model\Config;

use Magento\Framework\Data\OptionSourceInterface;

class CountryId implements OptionSourceInterface
{
    public function __construct(
        \Magento\Directory\Model\ResourceModel\Country\CollectionFactory $collectionFactory
    )
    {
        $this->region = $collectionFactory;
    }

    public function toOptionArray()
    {
        $country = [];
        $collection = $this->region->create();
        $items = $collection->addFieldToSelect('country_id')->getColumnValues('country_id');

        $countries = array_unique($items);
        foreach ($countries as $value) {
            $country[] = ['label' => $value, 'value' => $value];
        }
        return $country;
    }
}
