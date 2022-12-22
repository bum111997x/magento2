<?php

namespace CoWell\BasicTraining\ViewModel;

use CoWell\BasicTraining\Api\StudentRepositoryInterface;
use CoWell\BasicTraining\Model\StudentRepository;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\View\Element\Block\ArgumentInterface;

class Info implements ArgumentInterface
{

    private StudentRepositoryInterface $studentRepository;
    private RequestInterface $request;


    public function __construct(
        StudentRepositoryInterface $studentRepository,
        RequestInterface $request
    ) {
        $this->studentRepository = $studentRepository;
        $this->request = $request;
    }

    public function getInfoStudent()
    {
        $id = $this->request->getParam('entity_id');

        $student = $this->studentRepository->get($id);

        return $student;
    }
}
