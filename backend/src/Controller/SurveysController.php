<?php

namespace IWD\JOBINTERVIEW\Controller;

use IWD\JOBINTERVIEW\Repository\SurveyRepository;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

class SurveysController
{
    /**
     * @var SurveyRepository
     */
    private $surveyRepository;

    /**
     * @var NormalizerInterface
     */
    private $serializer;

    public function __construct(SurveyRepository $surveyRepository, NormalizerInterface $serializer)
    {
        $this->surveyRepository = $surveyRepository;
        $this->serializer = $serializer;
    }

    public function indexAction()
    {
        $models = $this->surveyRepository->findAll();
        $data = $this->serializer->normalize($models);

        return new JsonResponse($data);
    }

    public function aggregationAction()
    {
        $models = $this->surveyRepository->findAllWithAggregation();
        $data = $this->serializer->normalize($models, null, ['aggregation' => true]);

        return new JsonResponse($data);
    }
}
