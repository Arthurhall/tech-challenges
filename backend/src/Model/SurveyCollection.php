<?php

namespace IWD\JOBINTERVIEW\Model;

use ArrayObject;
use Exception;

class SurveyCollection extends ArrayObject
{
    public function offsetSet($index, $newval)
    {
        if (!$newval instanceof Survey) {
            throw new Exception();
        }

        return parent::offsetSet($index, $newval);
    }
}
