<?php

namespace IWD\JOBINTERVIEW\Repository;

use IWD\JOBINTERVIEW\Factory\Model\Behavior\ModelFactoryInterface;
use IWD\JOBINTERVIEW\Manager\Data\Behavior\DataManagerInterface;

abstract class AbstractRepository
{
    /**
     * @var DataManagerInterface
     */
    protected $dataManager;

    /**
     * @var ModelFactoryInterface
     */
    protected $modelFactory;

    /**
     * @var ModelFactoryInterface
     */
    protected $modelAggregationFactory;

    public function __construct(
        DataManagerInterface $dataManager,
        ModelFactoryInterface $modelFactory,
        ModelFactoryInterface $modelAggregationFactory
    ) {
        $this->dataManager = $dataManager;
        $this->modelFactory = $modelFactory;
        $this->modelAggregationFactory = $modelAggregationFactory;
    }
}
