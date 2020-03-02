<?php

namespace IWD\JOBINTERVIEW\Model\Question;

use IWD\JOBINTERVIEW\Model\Question\Behavior\QcmInterface;

class QuestionQcm extends AbstractQuestion implements QcmInterface
{
    /**
     * @var array
     */
    private $options;

    public function getOptions(): array
    {
        return $this->options;
    }

    public function setOptions(array $options)
    {
        $this->options = $options;

        return $this;
    }

    public function getAnswer(): array
    {
        return $this->answer;
    }

    public function setAnswer(array $answer)
    {
        $this->answer = $answer;

        return $this;
    }
}
