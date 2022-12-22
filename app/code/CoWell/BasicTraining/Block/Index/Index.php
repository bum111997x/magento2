<?php
namespace CoWell\BasicTraining\Block\Index;

use Magento\Framework\View\Element\Template;

class Index extends \Magento\Framework\View\Element\Template
{
    public function __construct(\Magento\Framework\View\Element\Template\Context $context, array $data = [])
    {
        parent::__construct($context, $data);
    }

    public function getTrainingContent(){
        return __('Training Content');
    }
}
