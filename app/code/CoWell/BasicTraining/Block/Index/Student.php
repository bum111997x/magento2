<?php

namespace CoWell\BasicTraining\Block\Index;

use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;

class Student extends Template
{
    /**
     * @param Context $context
     * @param array $data
     */
    public function __construct(
        Template\Context  $context,
        array             $data = []
    ) {
        parent::__construct($context, $data);
    }

    protected function _prepareLayout()
    {
        return $this->getCollection();
    }

    public function getPagerHtml()
    {
        return $this->getChildHtml('pager');
    }
}
