<?php

namespace CoWell\BasicTraining\Ui\Component\Listing\Column;

use Magento\Backend\Model\UrlInterface;
use Magento\Ui\Component\Listing\Columns\Column;
use Magento\Framework\View\Element\UiComponent\ContextInterface;
use Magento\Framework\View\Element\UiComponentFactory;

class Gender extends Column
{
    const ARRAY = [
     1 => 'Nam',
     2 => 'Nu'
    ];

    /**
     * URL builder
     *
     * @var \Magento\Framework\UrlInterface
     */
    public $_urlBuilder;
    /**
     * @param ContextInterface $context
     * @param UiComponentFactory $uiComponentFactory
     * @param UrlInterface $urlBuilder
     * @param array $components
     * @param array $data
     */
    public function __construct(
        ContextInterface $context,
        UiComponentFactory $uiComponentFactory,
        UrlInterface $urlBuilder,
        array $components = [],
        array $data = []
    ) {
        $this->_urlBuilder = $urlBuilder;
        parent::__construct($context, $uiComponentFactory, $components, $data);
    }
    /**
     * Prepare Data Source
     *
     * @param array $dataSource
     * @return array
     */
    public function prepareDataSource(array $dataSource)
    {
        if (isset($dataSource['data']['items'])) {
            foreach ($dataSource['data']['items'] as & $item) {
                if (isset($item['gender'])) {
                    $item['gender'] = self::ARRAY[$item['gender']];
                }
            }
        }
        return $dataSource;
    }
}
