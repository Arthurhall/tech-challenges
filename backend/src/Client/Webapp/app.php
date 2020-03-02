<?php
declare(strict_types=1);

if (!defined('ROOT_PATH')) {
    define('ROOT_PATH', realpath('.'));
}
if (!defined('API_VERSION')) {
    define('API_VERSION', '1.0');
}

if (file_exists(ROOT_PATH.'/vendor/autoload.php') === false) {
    echo "run this command first: composer install";
    exit();
}
require_once ROOT_PATH.'/vendor/autoload.php';

use IWD\JOBINTERVIEW\ {
    Controller\SurveysController,
    Factory\Model\SurveyAggregationFactory,
    Factory\Model\SurveyFactory,
    Manager\Data\JsonDataManager,
    Repository\SurveyRepository,
    Serializer\SurveySerializer,
};
use Silex\Application;
use Silex\Provider\ServiceControllerServiceProvider;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

$app = new Application();

$app[SurveySerializer::class] = function ($app) {
    return new SurveySerializer();
};
$app[JsonDataManager::class] = function ($app) {
    return new JsonDataManager($app[SurveySerializer::class]);
};
$app[SurveyFactory::class] = function ($app) {
    return new SurveyFactory();
};
$app[SurveyAggregationFactory::class] = function ($app) {
    return new SurveyAggregationFactory();
};
$app[SurveyRepository::class] = function ($app) {
    return new SurveyRepository(
        $app[JsonDataManager::class],
        $app[SurveyFactory::class],
        $app[SurveyAggregationFactory::class]
    );
};

$app->register(new ServiceControllerServiceProvider());

$app[SurveysController::class] = function($app) {
    return new SurveysController(
        $app[SurveyRepository::class],
        $app[SurveySerializer::class]
    );
};

$app->after(function (Request $request, Response $response) {
    $response->headers->set('Access-Control-Allow-Origin', '*');
    $response->headers->set('Api-Version', API_VERSION);
});
$app->get('/', function () use ($app) {
    return 'Status OK';
});

$app->get(sprintf('/api/%s/surveys', API_VERSION), SurveysController::class.":indexAction");
$app->get(sprintf('/api/%s/surveys/aggregation', API_VERSION), SurveysController::class.":aggregationAction");

$app->run();

return $app;
