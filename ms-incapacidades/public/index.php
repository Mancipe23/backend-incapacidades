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

$app->post('/incapacidades', function ($request, $response) {

    $data = $request->getParsedBody();

    $dias =
        (
            strtotime($data['fecha_fin'])
            -
            strtotime($data['fecha_inicio'])
        ) / 86400 + 1;

    $incapacidad =
        Incapacidad::create([

            'empleado_id' =>
                $data['empleado_id'],

            'fecha_inicio' =>
                $data['fecha_inicio'],

            'fecha_fin' =>
                $data['fecha_fin'],

            'tipo' =>
                $data['tipo'],

            'diagnostico_general' =>
                $data['diagnostico_general'],

            'entidad_medica' =>
                $data['entidad_medica'],

            'observaciones' =>
                $data['observaciones'],

            'dias_incapacidad' =>
                $dias,

            'estado' =>
                'registrada'
        ]);

    $response->getBody()->write(
        json_encode([
            'mensaje' =>
                'Incapacidad registrada',
            'data' =>
                $incapacidad
        ])
    );

    return $response
        ->withHeader(
            'Content-Type',
            'application/json'
        );
});

$app->run();