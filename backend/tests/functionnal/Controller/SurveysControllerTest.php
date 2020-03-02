<?php

namespace IWD\JOBINTERVIEW\Tests\Controller;

use Silex\WebTestCase;

class SurveysControllerTest extends WebTestCase
{
    public function createApplication()
    {
        $app = require __DIR__.'/../../../src/Client/Webapp/app.php';
        $app['debug'] = true;
        unset($app['exception_handler']);

        return $app;
    }

    public function testInitialPage()
    {
        $client = $this->createClient();
        $crawler = $client->request('GET', '/');

        $this->assertTrue($client->getResponse()->isOk());
        $this->assertEquals('Status OK', $client->getResponse()->getContent());
    }

    public function testSurveys()
    {
        $client = $this->createClient();
        $crawler = $client->request('GET', sprintf('/api/%s/surveys', API_VERSION));

        $this->assertTrue($client->getResponse()->isOk());
        $this->assertEquals('[{"name":"Chartres","code":"XX2"},{"name":"Paris","code":"XX1"},{"name":"Melun","code":"XX3"}]', $client->getResponse()->getContent());
    }

    public function testSurveysAggregation()
    {
        $client = $this->createClient();
        $crawler = $client->request('GET', sprintf('/api/%s/surveys/aggregation', API_VERSION));

        $this->assertTrue($client->getResponse()->isOk());
        $this->assertEquals('[{"name":"Chartres","code":"XX2","aggregation":{"numeric":4733.333333333333,"date":[{"date":"2017-08-25 12:04:50.000000","timezone_type":2,"timezone":"Z"},{"date":"2016-08-28 12:04:50.000000","timezone_type":2,"timezone":"Z"},{"date":"2017-08-26 12:04:50.000000","timezone_type":2,"timezone":"Z"},{"date":"2017-07-25 12:04:50.000000","timezone_type":2,"timezone":"Z"},{"date":"2017-09-25 12:04:50.000000","timezone_type":2,"timezone":"Z"},{"date":"2017-10-25 12:04:50.000000","timezone_type":2,"timezone":"Z"}],"qcm":{"Product 1":4,"Product 2":4,"Product 3":6,"Product 4":3,"Product 5":6,"Product 6":3}}},{"name":"Paris","code":"XX1","aggregation":{"numeric":697.2,"date":[{"date":"2017-09-14 09:45:00.000000","timezone_type":2,"timezone":"Z"},{"date":"2017-06-09 00:00:00.000000","timezone_type":2,"timezone":"Z"},{"date":"2016-03-29 11:04:50.000000","timezone_type":2,"timezone":"Z"},{"date":"2016-04-29 11:04:50.000000","timezone_type":2,"timezone":"Z"},{"date":"2016-02-28 11:04:50.000000","timezone_type":2,"timezone":"Z"}],"qcm":{"Product 1":0,"Product 2":2,"Product 3":1,"Product 4":0,"Product 5":4,"Product 6":0}}},{"name":"Melun","code":"XX3","aggregation":{"numeric":6200,"date":[{"date":"2017-10-25 12:04:50.000000","timezone_type":2,"timezone":"Z"},{"date":"2017-08-25 12:04:50.000000","timezone_type":2,"timezone":"Z"},{"date":"2017-09-25 12:04:50.000000","timezone_type":2,"timezone":"Z"},{"date":"2017-06-25 12:04:50.000000","timezone_type":2,"timezone":"Z"}],"qcm":{"Product 1":4,"Product 2":2,"Product 3":4,"Product 4":4,"Product 5":4,"Product 6":3}}}]', $client->getResponse()->getContent());
    }
}
