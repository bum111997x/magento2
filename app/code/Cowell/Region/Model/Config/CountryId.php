<?php
namespace Cowell\Region\Model\Config;

use Magento\Framework\Data\OptionSourceInterface;

class CountryId implements OptionSourceInterface
{
    protected $region;

    public function __construct(
        \Cowell\Region\Model\ResourceModel\Region $region
    )
    {
        $this->region = $region;
    }

    public function toOptionArray()
    {
        $countryId = $this->region->getCountryId();

        $array = [];
        foreach ($countryId as $key => $item){
            $array[] = ['value' => $key, 'label' => $item];
        }


        return $array;
    }
}
