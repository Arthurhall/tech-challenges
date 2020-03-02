<?php

namespace IWD\JOBINTERVIEW\Model\Question\Behavior;

interface NumericInterface
{
    public function getAnswer(): int;
    public function setAnswer(int $answer);
}
