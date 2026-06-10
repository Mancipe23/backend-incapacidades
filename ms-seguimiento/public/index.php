<?php

require __DIR__ . '/../vendor/autoload.php';

use Slim\Factory\AppFactory;
use Dotenv\Dotenv;
use App\Models\Seguimiento;

$dotenv = Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();

require __DIR__ . '/../app/Config/database.php';

$app = AppFactory::create();

$app->setBasePath('/backend-incapacidades/ms-seguimiento/public');

$app->addBodyParsingMiddleware();

$app->get('/', function ($request, $response) {

    $response->getBody()->write(
        'Microservicio Seguimiento funcionando'
    );

    return $response;
});

$app->get('/prueba', function ($request, $response) {

    $response->getBody()->write(
        'Ruta prueba OK'
    );

    return $response;
});

$app->get('/seguimientos', function ($request, $response) {

    $seguimientos = Seguimiento::all();

    $response->getBody()->write(
        json_encode($seguimientos)
    );

    return $response
        ->withHeader(
            'Content-Type',
            'application/json'
        );
});

$app->run();