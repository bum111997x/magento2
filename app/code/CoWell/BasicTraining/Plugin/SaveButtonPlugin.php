<?php

namespace CoWell\BasicTraining\Plugin;

class SaveButtonPlugin
{
    public function afterGetButtonData(\Magento\Customer\Block\Adminhtml\Edit\SaveButton $subject, $result)
    {
        $result['label'] = __('Save ');
        return $result;
    }
}
