<?php

require __DIR__ . '/../vendor/autoload.php';

use Slim\Factory\AppFactory;
use Dotenv\Dotenv;
use App\Models\Empleado;

$dotenv = Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();

require __DIR__ . '/../app/Config/database.php';

$app = AppFactory::create();

$app->setBasePath('/backend-incapacidades/ms-empleados/public');

$app->addBodyParsingMiddleware();

$app->get('/', function ($request, $response) {

    $response->getBody()->write(
        'Microservicio Empleados funcionando'
    );

    return $response;
});

$app->get('/empleados', function ($request, $response) {

    $empleados = Empleado::all();

    $response->getBody()->write(
        json_encode($empleados)
    );

    return $response
        ->withHeader(
            'Content-Type',
            'application/json'
        );
});

$app->post('/empleados', function ($request, $response) {

    $data = $request->getParsedBody();

    $empleado = Empleado::create([

        'nombres' =>
            $data['nombres'],

        'apellidos' =>
            $data['apellidos'],

        'documento' =>
            $data['documento'],

        'correo' =>
            $data['correo'],

        'telefono' =>
            $data['telefono'],

        'cargo' =>
            $data['cargo'],

        'area' =>
            $data['area'],

        'fecha_ingreso' =>
            $data['fecha_ingreso'],

        'estado' =>
            'activo'
    ]);

    $response->getBody()->write(
        json_encode([
            'mensaje' =>
                'Empleado registrado',
            'data' =>
                $empleado
        ])
    );

    return $response
        ->withHeader(
            'Content-Type',
            'application/json'
        );
});

$app->get('/prueba', function ($request, $response) {

    $response->getBody()->write('Ruta prueba OK');

    return $response;
});

$app->run();