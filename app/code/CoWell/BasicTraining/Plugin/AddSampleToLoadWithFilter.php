<?php

namespace CoWell\BasicTraining\Plugin;

use Magento\Framework\Data\Collection;

class AddSampleToLoadWithFilter
{
    /**
     * @param Collection $subject
     * @param bool $printQuery
     * @param bool $logQuery
     * @return array
     */
    public function beforeLoadWithFilter(Collection $subject, $printQuery = false, $logQuery = false): array
    {
        if ($subject->getMainTable() == 'sales_order_grid') {
            $subject->getSelect()->joinleft(
                ['sf' => 'sales_order_shipping_fee'],
                "main_table.entity_id = sf.sales_order_id",
            );
            return [$printQuery, $logQuery];
        }
        return [$printQuery, $logQuery];
    }
}
