<?php

namespace IWD\JOBINTERVIEW\Tests\Repository;

use IWD\JOBINTERVIEW\Factory\Model\Behavior\ModelFactoryInterface;
use IWD\JOBINTERVIEW\Manager\Data\Behavior\DataManagerInterface;
use IWD\JOBINTERVIEW\Model\SurveyCollection;
use IWD\JOBINTERVIEW\Repository\SurveyRepository;
use PHPUnit\Framework\TestCase;

/**
 * @todo Same tests with "findAllWithAggregation" method.
 */
class SurveyRepositoryTest extends TestCase
{
    public function testFindAllEmptyData()
    {
        $dataManager = $this->createMock(DataManagerInterface::class);
        $modelFactory = $this->createMock(ModelFactoryInterface::class);
        $modelAggregationFactory = $this->createMock(ModelFactoryInterface::class);

        $dataManager->expects($this->once())
            ->method('fetchAll')
            ->with()
            ->willReturn([]);

        $modelFactory->expects($this->once())
            ->method('createAll')
            ->with([])
            ->willReturn($this->createMock(SurveyCollection::class));

        $modelAggregationFactory->expects($this->never())
            ->method('createAll');

        $repository = new SurveyRepository($dataManager, $modelFactory, $modelAggregationFactory);
        $this->assertInstanceOf(SurveyCollection::class, $repository->findAll());
    }

    public function testFindAll()
    {
        $dataManager = $this->createMock(DataManagerInterface::class);
        $modelFactory = $this->createMock(ModelFactoryInterface::class);
        $modelAggregationFactory = $this->createMock(ModelFactoryInterface::class);

        $survey1 = [
            'survey' => [
                'name' => 'test 1',
                'code' => 't1'
            ],
            'questions' => [
                ['type' => 'numeric', 'label' => 'Number of products?', 'answer' => 5200]
            ]
        ];

        $dataManager->expects($this->once())
            ->method('fetchAll')
            ->with()
            ->willReturn($survey1);

        $modelFactory->expects($this->once())
            ->method('createAll')
            ->with($survey1)
            ->willReturn($this->createMock(SurveyCollection::class));

        $modelAggregationFactory->expects($this->never())
            ->method('createAll');

        $repository = new SurveyRepository($dataManager, $modelFactory, $modelAggregationFactory);
        $this->assertInstanceOf(SurveyCollection::class, $repository->findAll());
    }
}
