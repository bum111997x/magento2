<?php

namespace CoWell\BasicTraining\Model\Config;

use Magento\Framework\Data\OptionSourceInterface;

class MassAction implements OptionSourceInterface
{

    public function toOptionArray()
    {
        return [
            ['value' => 'cancel', 'label' => __('Cancel')],
            ['value' => 'hold_order', 'label' => __('Hold Order')],
            ['value' => 'unhold_order', 'label' => __('Unhold')],
            ['value' => 'pdfinvoices_order', 'label' => __('Print Invoices')],
            ['value' => 'pdfshipments_order', 'label' => __('Print Packing Slips')],
            ['value' => 'pdfcreditmemos_order', 'label' => __('Print Credit Memos')],
            ['value' => 'pdfdocs_order', 'label' => __('Print All')],
            ['value' => 'print_shipping_label', 'label' => __('Print Shipping Labels')]
        ];
    }
}
