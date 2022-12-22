<?php
declare(strict_types=1);

namespace CoWell\BasicTraining\Controller\Index;

use Magento\Framework\App\Action\Context;
use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\View\Result\PageFactory;
use \Magento\Framework\App\Action\Action;

class Student extends Action implements HttpGetActionInterface
{
    /**
     * @var PageFactory
     */
    protected $_pageFactory;

    /**
     * @var RequestInterface
     */

    protected $request;


    /**
     * @param Context $context
     * @param PageFactory $pageFactory
     * @param RequestInterface $request
     */
    public function __construct(Context $context, PageFactory $pageFactory, RequestInterface $request)
    {
        $this->_pageFactory = $pageFactory;
        $this->request = $request;
        parent::__construct($context);
    }

    public function execute()
    {
        return $this->_pageFactory->create();
    }
}
