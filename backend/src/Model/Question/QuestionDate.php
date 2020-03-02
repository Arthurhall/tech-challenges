<?php

namespace IWD\JOBINTERVIEW\Model\Question;

use DateTime;
use IWD\JOBINTERVIEW\Model\Question\Behavior\DateInterface;

class QuestionDate extends AbstractQuestion implements DateInterface
{
    public function getAnswer(): DateTime
    {
        return $this->answer;
    }

    public function setAnswer(DateTime $answer)
    {
        $this->answer = $answer;

        return $this;
    }
}
