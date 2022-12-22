<?php

namespace CoWell\BasicTraining\Plugin;

class GetNameProductPlugin
{
    public function beforeSetName(\Magento\Catalog\Model\Product $subject, $name)
    {
        return ['(' . $name  . ')'];
    }

    public function beforeGetName(\Magento\Catalog\Model\Product $subject)
    {
        $subject->getData()['name'] = $subject->getData()['name']  . 'Xin Chao 123';
        return $subject;
    }

    public function afterGetName(\Magento\Catalog\Model\Product $subject, $result)
    {
        return $result.' Hello World 123';
    }


}
