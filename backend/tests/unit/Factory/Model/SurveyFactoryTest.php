<?php

namespace IWD\JOBINTERVIEW\Tests\Factory\Model;

use IWD\JOBINTERVIEW\Factory\Model\SurveyFactory;
use IWD\JOBINTERVIEW\Model\SurveyCollection;
use PHPUnit\Framework\TestCase;

class SurveyFactoryTest extends TestCase
{
    public function testCreateAllEmptyData()
    {
        $factory = new SurveyFactory();

        $this->assertInstanceOf(SurveyCollection::class, $factory->createAll([]));
    }

    /**
     * @dataProvider surveySuccessProvider
     */
    public function testCreateAllSuccess($survey)
    {
        $factory = new SurveyFactory();

        $this->assertInstanceOf(SurveyCollection::class, $factory->createAll($survey));
    }

    public function surveySuccessProvider()
    {
        $survey1 = [
            'survey' => [
                'name' => 'test 1',
                'code' => 't1'
            ],
            'questions' => [
                ['type' => 'numeric', 'label' => 'Number of products?', 'answer' => 5200]
            ]
        ];
        $survey2 = [
            'survey' => [
                'name' => 'test 2',
                'code' => 't2'
            ],
            'questions' => [
                ['type' => 'date', 'label' => 'date label', 'answer' => '2017-08-25T12:04:50.000Z']
            ]
        ];
        $survey3 = [
            'survey' => [
                'name' => 'test 3',
                'code' => 't3'
            ],
            'questions' => [
                ['type' => 'qcm', 'label' => 'qcm label', 'answer' => [true, true, true, false, true, false], "options" => ["Product 1", "Product 2", "Product 3", "Product 4", "Product 5", "Product 6"],]
            ]
        ];

        return [
            [0 => [$survey1]],
            [1 => [$survey2]],
            [2 => [$survey3]],
        ];
    }
}
