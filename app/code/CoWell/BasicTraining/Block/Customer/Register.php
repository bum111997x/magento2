<?php

namespace CoWell\BasicTraining\Block\Customer;

use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;

class Register extends Template
{
    public function __construct(
        Context $context,
        array   $data = []
    ) {
        parent::__construct($context, $data);
    }
}
