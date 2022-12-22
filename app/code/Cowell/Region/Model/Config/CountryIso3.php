<?php

namespace Cowell\Region\Model\Config;

use Magento\Framework\Data\OptionSourceInterface;

class CountryIso3 implements OptionSourceInterface
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
        $items = $collection->getItems();

        foreach ($items as $value) {
            $country[] = ['label' => $value->getCountryId(), 'value' => $value->getData('iso3_code')];
        }
        return $country;
    }
}
