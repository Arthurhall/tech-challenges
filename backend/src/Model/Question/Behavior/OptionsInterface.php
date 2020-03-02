<?php

namespace IWD\JOBINTERVIEW\Model\Question\Behavior;

interface OptionsInterface
{
    public function getOptions(): array;
    public function setOptions(array $options);
}
