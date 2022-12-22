<?php

namespace CoWell\BasicTraining\Plugin;

class GetOrderOptionsPlugin
{
    public function afterGetOrderOptions($subject, $result)
    {
        if ($subject->getRequest()->getFullActionName() !== 'sales_order_view') {
            return $result;
        }
        $options = [];
        if ($subject->getItem()->getShippingFee()) {
            $options[] = [
                'label' => __('Shipping Fee'),
                "value" => $subject->getItem()->getShippingFee()
            ];
        }
        return array_merge($options, $result);
    }
}
