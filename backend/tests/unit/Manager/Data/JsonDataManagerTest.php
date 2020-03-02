<?php

namespace IWD\JOBINTERVIEW\Tests\Manager\Data;

use IWD\JOBINTERVIEW\Manager\Data\JsonDataManager;
use IWD\JOBINTERVIEW\Serializer\SurveySerializer;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Serializer\Encoder\DecoderInterface;

class JsonDataManagerTest extends TestCase
{
    public function testConstructor()
    {
        $serializer = $this->createMock(DecoderInterface::class);
        $manager = new JsonDataManager($serializer);
        $this->assertTrue(is_object($manager));
    }

    public function testFetchAll()
    {
        $serializer = new SurveySerializer();
        $manager = new JsonDataManager($serializer);
        $data = $manager->fetchAll();
        $this->assertCount(15, $data);
    }
}
