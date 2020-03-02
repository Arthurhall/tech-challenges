<?php

namespace IWD\JOBINTERVIEW\Repository;

use IWD\JOBINTERVIEW\Model\SurveyCollection;
use IWD\JOBINTERVIEW\Repository\Behavior\RepositoryInterface;

class SurveyRepository extends AbstractRepository implements RepositoryInterface
{
    public function findAll(): SurveyCollection
    {
        $data = $this->dataManager->fetchAll();
        $models = $this->modelFactory->createAll($data);

        return $models;
    }

    public function findAllWithAggregation(): SurveyCollection
    {
        $data = $this->dataManager->fetchAll();
        $models = $this->modelFactory->createAll($data);
        $this->modelAggregationFactory->createAll($models);

        return $models;
    }
}
