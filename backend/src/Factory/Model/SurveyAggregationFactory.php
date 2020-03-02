<?php

namespace IWD\JOBINTERVIEW\Factory\Model;

use ArrayObject;
use IWD\JOBINTERVIEW\Factory\Model\Behavior\ModelFactoryInterface;
use IWD\JOBINTERVIEW\Model\AnswerAggregation;
use IWD\JOBINTERVIEW\Model\Survey;
use IWD\JOBINTERVIEW\Model\SurveyCollection;

class SurveyAggregationFactory implements ModelFactoryInterface
{
    public function createAll(iterable $collection): iterable
    {
        return $this->createAggregation($collection);
    }

    private function createAggregation(SurveyCollection $collection): ArrayObject
    {
        foreach ($collection as $survey) {
            $aggregation = $this->create($survey);
            $survey->setAnswerAggregation($aggregation);
        }

        return $collection;
    }

    private function create(Survey $survey): AnswerAggregation
    {
        $aggregation = new AnswerAggregation();

        $this->aggregateNumeric($survey, $aggregation);
        $this->aggregateDate($survey, $aggregation);
        $this->aggregateQcm($survey, $aggregation);

        return $aggregation;
    }

    /**
     * @param Survey $survey
     * @param AnswerAggregation $aggregation
     */
    private function aggregateNumeric(Survey $survey, AnswerAggregation $aggregation)
    {
        $numerics = [];
        foreach ($survey->getQuestionNumerics() as $questionNumeric) {
            $numerics[] = $questionNumeric->getAnswer();
        }
        $avg = (count($numerics) > 0) ? array_sum($numerics) / count($numerics) : 0;
        $aggregation->setNumeric($avg);
    }

    /**
     * @param Survey $survey
     * @param AnswerAggregation $aggregation
     */
    private function aggregateDate(Survey $survey, AnswerAggregation $aggregation)
    {
        $dates = [];
        foreach ($survey->getQuestionDates() as $questionDate) {
            $dates[] = $questionDate->getAnswer();
        }
        $aggregation->setDate($dates);
    }

    /**
     * @param Survey $survey
     * @param AnswerAggregation $aggregation
     */
    private function aggregateQcm(Survey $survey, AnswerAggregation $aggregation)
    {
        $qcm = [];
        foreach ($survey->getQuestionQcms() as $questionQcm) {
            foreach ($questionQcm->getOptions() as $key => $option) {
                if (!isset($qcm[$option])) {
                    $qcm[$option] = $questionQcm->getAnswer()[$key] ? 1 : 0;
                } else {
                    $qcm[$option] += $questionQcm->getAnswer()[$key] ? 1 : 0;
                }
            }
        }
        $aggregation->setQcm($qcm);
    }
}
