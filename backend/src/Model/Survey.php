<?php

namespace IWD\JOBINTERVIEW\Model;

use ArrayObject;
use IWD\JOBINTERVIEW\ {
    Exception\UnknownQuestionTypeException,
    Model\Question\AbstractQuestion,
    Model\Question\QuestionDate,
    Model\Question\QuestionNumeric,
    Model\Question\QuestionQcm
};

class Survey
{
    /**
     * @var string
     */
    private $code;

    /**
     * @var string
     */
    private $name;

    /**
     * @var ArrayObject|QuestionDate[]
     */
    private $questionDates;

    /**
     * @var ArrayObject|QuestionNumeric[]
     */
    private $questionNumerics;

    /**
     * @var ArrayObject|QuestionQcm[]
     */
    private $questionQcms;

    /**
     * @var AnswerAggregation|null
     */
    private $answerAggregation;

    public function __construct()
    {
        $this->questionDates = new ArrayObject();
        $this->questionNumerics = new ArrayObject();
        $this->questionQcms = new ArrayObject();
    }

    public function addQuestion(AbstractQuestion $question): self
    {
        switch (get_class($question)) {
            case QuestionDate::class:
                $this->questionDates->append($question);
                return $this;
            case QuestionNumeric::class:
                $this->questionNumerics->append($question);
                return $this;
            case QuestionQcm::class:
                $this->questionQcms->append($question);
                return $this;

            default: throw new UnknownQuestionTypeException();
        }
    }

    public function getCode(): string
    {
        return $this->code;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setCode(string $code): self
    {
        $this->code = $code;

        return $this;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getQuestionDates(): ArrayObject
    {
        return $this->questionDates;
    }

    /**
     * @return ArrayObject|QuestionNumeric[]
     */
    public function getQuestionNumerics()
    {
        return $this->questionNumerics;
    }

    public function getQuestionQcms(): ArrayObject
    {
        return $this->questionQcms;
    }

    public function setQuestionDates(ArrayObject $questionDates): self
    {
        $this->questionDates = $questionDates;

        return $this;
    }

    public function setQuestionNumerics(ArrayObject $questionNumerics): self
    {
        $this->questionNumerics = $questionNumerics;

        return $this;
    }

    public function setQuestionQcms(ArrayObject $questionQcms): self
    {
        $this->questionQcms = $questionQcms;

        return $this;
    }

    public function getAnswerAggregation(): ?AnswerAggregation
    {
        return $this->answerAggregation;
    }

    public function setAnswerAggregation(?AnswerAggregation $answerAggregation)
    {
        $this->answerAggregation = $answerAggregation;

        return $this;
    }
}
