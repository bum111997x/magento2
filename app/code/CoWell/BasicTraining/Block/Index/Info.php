<?php
namespace CoWell\BasicTraining\Block\Index;

use CoWell\BasicTraining\Model\ResourceModel\Student\CollectionFactory;

use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;

class Info extends Template
{
    public function __construct(
        Context $context,
        array   $data = []
    ) {
        parent::__construct($context, $data);
    }
}
