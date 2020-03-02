<?php

namespace IWD\JOBINTERVIEW\Factory\Model;

use DateTime;
use IWD\JOBINTERVIEW\Exception\UnknownQuestionTypeException;
use IWD\JOBINTERVIEW\Factory\Model\Behavior\ModelFactoryInterface;
use IWD\JOBINTERVIEW\Model\Question\AbstractQuestion;
use IWD\JOBINTERVIEW\Model\Question\QuestionDate;
use IWD\JOBINTERVIEW\Model\Question\QuestionNumeric;
use IWD\JOBINTERVIEW\Model\Question\QuestionQcm;
use IWD\JOBINTERVIEW\Model\Survey;
use IWD\JOBINTERVIEW\Model\SurveyCollection;

class SurveyFactory implements ModelFactoryInterface
{
    public function createAll(iterable $data): iterable
    {
        return $this->createSurveyCollection($data);
    }

    private function createSurveyCollection(array $data = []): SurveyCollection
    {
        $collection = new SurveyCollection();
        foreach ($data as $dataSurvey) {
            $survey = $this->create($dataSurvey, $collection);
        }

        return $collection;
    }

    private function create(array $dataSurvey, SurveyCollection $collection): Survey
    {
        $code = $dataSurvey['survey']['code'];

        if (!$collection->offsetExists($code)) {
            $survey = new Survey();
            $survey->setCode($code);
            $survey->setName($dataSurvey['survey']['name']);

            $collection->offsetSet($code, $survey);
        } else {
            $survey = $collection->offsetGet($code);
        }

        foreach ($dataSurvey['questions'] as $dataQuestion) {
            $question = $this->createQuestion($dataQuestion);
            $survey->addQuestion($question);
        }

        return $survey;
    }

    private function createQuestion(array $dataQuestion): AbstractQuestion
    {
        switch ($dataQuestion['type']) {
            case AbstractQuestion::TYPE_DATE:
                $question = new QuestionDate();

                return $question
                    ->setAnswer(new DateTime($dataQuestion['answer']))
                    ->setLabel($dataQuestion['label']);

            case AbstractQuestion::TYPE_NUMERIC:
                $question = new QuestionNumeric();

                return $question
                    ->setAnswer($dataQuestion['answer'])
                    ->setLabel($dataQuestion['label']);

            case AbstractQuestion::TYPE_QCM:
                $question = new QuestionQcm();

                return $question
                    ->setAnswer($dataQuestion['answer'])
                    ->setOptions($dataQuestion['options'])
                    ->setLabel($dataQuestion['label']);

            default: throw new UnknownQuestionTypeException();
        }
    }
}
