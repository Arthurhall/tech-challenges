<?php

namespace IWD\JOBINTERVIEW\Model;

class AnswerAggregation
{
    /**
     * How much Product 1, how much Product 2...
     *
     * @var array
     */
    private $qcm;

    /**
     * List of dates.
     *
     * @var array
     */
    private $date;

    /**
     * The average of all answers.
     *
     * @var float
     */
    private $numeric;

    public function getQcm(): array
    {
        return $this->qcm;
    }

    public function getDate(): array
    {
        return $this->date;
    }

    public function getNumeric(): float
    {
        return $this->numeric;
    }

    public function setQcm(array $qcm)
    {
        $this->qcm = $qcm;

        return $this;
    }

    public function setDate(array $date)
    {
        $this->date = $date;

        return $this;
    }

    public function setNumeric(float $numeric)
    {
        $this->numeric = $numeric;

        return $this;
    }
}
