<?php

namespace IWD\JOBINTERVIEW\Model\Question\Behavior;

use DateTime;

interface DateInterface
{
    public function getAnswer(): DateTime;
    public function setAnswer(DateTime $answer);
}
