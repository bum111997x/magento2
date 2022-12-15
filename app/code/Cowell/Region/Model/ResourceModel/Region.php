<?php

namespace Cowell\Region\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class Region extends AbstractDb
{

    /**
     * @inheritDoc
     */
    protected function _construct()
    {
        $this->_init('directory_country_region', 'region_id');
    }

    public function getCountryId(){
        $connect = $this->getConnection();
        $table = $connect->getTableName('directory_country');
        $countryId = $connect->fetchCol('SELECT country_id FROM ' . $table);

        return $countryId;
    }

    public function saveLocaleName($data, $region_id ,$update=null){
        $connect = $this->getConnection();
        $array = [
            'locale' => $data[0]['locale'],
            'region_id' => $region_id,
            'name' => $data[0]['value']
        ];

        if ($update){
            $connect->delete('directory_country_region_name', $region_id);
        }
        $connect->insert('directory_country_region_name', $array);
    }
}
