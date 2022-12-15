<?php

namespace Cowell\ProductShippingMethod\Plugin;

class GetItemOptionsPlugin
{
    public function afterGetItemOptions($subject, $result){
        $data = [[
            'label' => 'Payment Fee',
            'value' => $subject->getItem()->getPaymentFee() ? $subject->getItem()->getPaymentFee() : 0
        ]];

        return array_merge($result,$data);
    }
}
