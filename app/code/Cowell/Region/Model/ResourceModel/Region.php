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

    public function saveLocaleName($data, $region_id ,$update=null){
        $connect = $this->getConnection();

        $array = [];

        foreach ($data as $item){
            $array[] = [
                'locale' => $item['locale'],
                'region_id' => $region_id,
                'name' => $item['value']
            ];
        }
        if ($update){
            $connect->insertOnDuplicate('directory_country_region_name', $array);
        }
        $connect->insertMultiple('directory_country_region_name', $array);

    }


}
