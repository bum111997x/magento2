<?php

namespace CoWell\BasicTraining\Model\Config;

use Magento\Framework\Data\OptionSourceInterface;

class Gender implements OptionSourceInterface
{

    public function toOptionArray()
    {
        return [
            ['value' => 1, 'label' => __('Nam')],
            ['value' => 2, 'label' => __('Nu')]
        ];
    }
}
