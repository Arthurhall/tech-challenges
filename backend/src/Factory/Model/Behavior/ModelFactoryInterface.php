<?php

namespace IWD\JOBINTERVIEW\Factory\Model\Behavior;

interface ModelFactoryInterface
{
    public function createAll(iterable $data): iterable;
}
