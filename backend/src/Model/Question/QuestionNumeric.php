<?php

namespace IWD\JOBINTERVIEW\Model\Question;

use IWD\JOBINTERVIEW\Model\Question\Behavior\NumericInterface;

class QuestionNumeric extends AbstractQuestion implements NumericInterface
{
    public function getAnswer(): int
    {
        return $this->answer;
    }

    public function setAnswer(int $answer)
    {
        $this->answer = $answer;

        return $this;
    }
}
