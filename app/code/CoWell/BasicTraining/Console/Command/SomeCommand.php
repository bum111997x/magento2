<?php

namespace CoWell\BasicTraining\Console\Command;

use CoWell\BasicTraining\Model\ResourceModel\Student\CollectionFactory;
use Magento\Framework\App\State;
use Magento\Framework\Mail\Template\TransportBuilder;
use Magento\Framework\Translate\Inline\StateInterface;
use Magento\Store\Model\StoreManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputOption;

class SomeCommand extends Command
{

    const NAME = 'name';
    protected StoreManagerInterface $storeManager;
    protected StateInterface $inlineTranslation;
    protected TransportBuilder $transportBuilder;
    protected State $state;
    protected CollectionFactory $studentCollectionFactory;

    public function __construct(
        StoreManagerInterface $storeManager,
        StateInterface $inlineTranslation,
        TransportBuilder $transportBuilder,
        CollectionFactory $studentCollectionFactory,
        State $state,
        string $name = null
    ) {
        $this->storeManager = $storeManager;
        $this->inlineTranslation = $inlineTranslation;
        $this->transportBuilder = $transportBuilder;
        $this->state = $state;
        $this->studentCollectionFactory = $studentCollectionFactory;
        parent::__construct($name);
    }

    protected function configure()
    {
        $options = [
            new InputOption(
                self::NAME,
                null,
                InputOption::VALUE_REQUIRED,
                'Name'
            )
        ];

        $this->setName('example:sayhello')
            ->setDescription('Demo command line')
            ->setDefinition($options);

        parent::configure();
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this->state->setAreaCode(\Magento\Framework\App\Area::AREA_FRONTEND);

        $collection = $this->studentCollectionFactory->create();

        $students = $collection->addFieldToFilter('dob', ['eq' => '2012-10-02'])->getItems();

        if ($students != null) {
            foreach ($students as $student) {
                $templateOptions = array('area' => \Magento\Framework\App\Area::AREA_FRONTEND,
                    'store' => $this->storeManager->getStore()->getId());
                $templateVars = array(
                    'store' => $this->storeManager->getStore(),
                    'customer_name' => $student->getName(),
                    'message'    => 'Hello World!!.'
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

        if ($name = $input->getOption(self::NAME)) {
            $output->writeln("Hello " . $name);
        } else {
            $output->writeln("Hello World");
        }
        return $this;
    }
}
