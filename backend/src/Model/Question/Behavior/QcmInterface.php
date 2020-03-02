<?php

namespace IWD\JOBINTERVIEW\Model\Question\Behavior;

interface QcmInterface extends OptionsInterface
{
    public function getAnswer(): array;
    public function setAnswer(array $answer);
}
