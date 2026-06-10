<?php

require __DIR__ . '/../vendor/autoload.php';

use Slim\Factory\AppFactory;
use Dotenv\Dotenv;
use App\Models\Incapacidad;

$dotenv = Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();

require __DIR__ . '/../app/Config/database.php';

$app = AppFactory::create();

$app->setBasePath('/backend-incapacidades/ms-incapacidades/public');

$app->addBodyParsingMiddleware();

$app->get('/', function ($request, $response) {

    $response->getBody()->write(
        'Microservicio Incapacidades funcionando'
    );

    return $response;
});

$app->get('/prueba', function ($request, $response) {

    $response->getBody()->write(
        'Ruta prueba OK'
    );

    return $response;
});

$app->get('/incapacidades', function ($request, $response) {

    $incapacidades = Incapacidad::all();

    $response->getBody()->write(
        json_encode($incapacidades)
    );

    return $response
        ->withHeader(
            'Content-Type',
            'application/json'
        );
});

$app->run();