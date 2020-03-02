<?php

namespace IWD\JOBINTERVIEW\Model\Question;

abstract class AbstractQuestion
{
    const TYPE_QCM = 'qcm';
    const TYPE_DATE = 'date';
    const TYPE_NUMERIC = 'numeric';

    /**
     * @var string
     */
    protected $label;

    /**
     * @var mixed
     */
    protected $answer;

    public function getLabel(): string
    {
        return $this->label;
    }

    public function setLabel(string $label)
    {
        $this->label = $label;
        return $this;
    }
}
