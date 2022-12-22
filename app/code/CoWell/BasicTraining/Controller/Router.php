<?php
declare(strict_types=1);

namespace CoWell\BasicTraining\Controller;

use Magento\Framework\App\Action\Forward;
use Magento\Framework\App\ActionFactory;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\App\RouterInterface;

class Router implements RouterInterface
{
    /**
     * @var ActionFactory
     */
    private $actionFactory;

    /**
     * @var ResponseInterface
     */
    private $response;
    /**
     * @param ActionFactory $actionFactory
     * @param ResponseInterface $response
     */
    public function __construct(
        ActionFactory $actionFactory,
        ResponseInterface $response
    ) {
        $this->actionFactory = $actionFactory;
        $this->response = $response;
    }

    public function match(RequestInterface $request)
    {
        $identifier = trim($request->getRequestString(), '/');
        $arrayURL = explode('/', $identifier);

        if (strpos($identifier, 'students') !== false && count($arrayURL) == 1) {
            $request->setModuleName('training');
            $request->setControllerName('index');
            $request->setActionName('student');

            return $this->actionFactory->create(Forward::class, ['request' => $request]);
        }

        if (strpos($identifier, 'student') !== false && count($arrayURL) == 2
            && $arrayURL[0] == 'student' && is_numeric($arrayURL[1])) {
            $request->setModuleName('training');
            $request->setControllerName('index');
            $request->setActionName('info');
            $request->setParams([
                'entity_id' => $arrayURL[1],
            ]);

            return $this->actionFactory->create(Forward::class, ['request' => $request]);
        }

        return null;
    }
}
