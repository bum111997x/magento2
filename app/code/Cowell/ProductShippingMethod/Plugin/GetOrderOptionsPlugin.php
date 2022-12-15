<?php

namespace Cowell\ProductShippingMethod\Plugin;

class GetOrderOptionsPlugin
{
    public function afterGetOrderOptions($subject, $result)
    {
        if ($subject->getRequest()->getFullActionName() !== 'sales_order_view') {
            return $result;
        }
        $options = [];
        if ($subject->getItem()->getPaymentFee()) {
            $options[] = [
                'label' => __('Payment Fee'),
                "value" => $subject->getItem()->getPaymentFee()
            ];
        }
        return array_merge($options, $result);
    }
}
