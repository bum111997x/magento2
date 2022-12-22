<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace CoWell\BasicTraining\Cron;

use Magento\Framework\Mail\Template\TransportBuilder;
use Magento\Framework\Translate\Inline\StateInterface;
use Magento\Store\Model\StoreManagerInterface;
use CoWell\BasicTraining\Model\ResourceModel\Student\CollectionFactory;

class Test
{

    protected StoreManagerInterface $storeManager;
    protected StateInterface $inlineTranslation;
    protected TransportBuilder $transportBuilder;
    protected CollectionFactory $studentCollectionFactory;


    public function __construct(
        StoreManagerInterface $storeManager,
        StateInterface        $inlineTranslation,
        TransportBuilder      $transportBuilder,
        CollectionFactory     $studentCollectionFactory,
    ) {
        $this->storeManager = $storeManager;
        $this->inlineTranslation = $inlineTranslation;
        $this->transportBuilder = $transportBuilder;
        $this->studentCollectionFactory = $studentCollectionFactory;
    }

    /**
     * Execute the cron
     *
     * @return void
     */
    public function execute()
    {
        $collection = $this->studentCollectionFactory->create();
        $students = $collection->addFieldToFilter('dob', ['eq' => '2012-10-02'])->getItems();
        $date = date('Y-m-d');
        if ($students != null) {
            foreach ($students as $student) {
                $templateOptions = array('area' => \Magento\Framework\App\Area::AREA_FRONTEND,
                    'store' => $this->storeManager->getStore()->getId());
                $templateVars = array(
                    'store' => $this->storeManager->getStore(),
                    'customer_name' => $student->getName(),
                    'message' => 'Hello World!!.'
                );
                $from = array('email' => "tungnt85050@co-well.vn", 'name' => $student->getName());
                $this->inlineTranslation->suspend();
                $to = array('tungnguyen111997x@gmail.com');
                $transport = $this->transportBuilder->setTemplateIdentifier('manage_mail_template')
                    ->setTemplateOptions($templateOptions)
                    ->setTemplateVars($templateVars)
                    ->setFrom($from)
                    ->addTo($to)
                    ->getTransport();
                $transport->sendMessage();
                $this->inlineTranslation->resume();
            }
        }
    }
}
