<?php

require __DIR__ . '/../vendor/autoload.php';

use Slim\Factory\AppFactory;
use Dotenv\Dotenv;
use App\Models\Usuario;
use App\Controllers\AuthController;

// Cargar .env
$dotenv = Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();

// Conexion BD
require __DIR__ . '/../app/Config/database.php';

// Crear app Slim
$app = AppFactory::create();

$app->setBasePath('/backend-incapacidades/ms-auth/public');

$app->addBodyParsingMiddleware();

$app->get('/', function ($request, $response) {

    $response->getBody()->write('Slim funcionando');

    return $response;
});

// Ruta de prueba
$app->get('/usuarios', function ($request, $response) {

    $usuarios = Usuario::all();

    $response->getBody()->write(
        json_encode($usuarios)
    );

    return $response
        ->withHeader('Content-Type', 'application/json');
});

$authController = new AuthController();

$app->post(
    '/login',
    [$authController, 'login']
);

$app->get('/login-test', function ($request, $response) {

    $usuario = Usuario::where(
        'usuario',
        'admin'
    )->first();

    $response->getBody()->write(
        json_encode($usuario)
    );

    return $response
        ->withHeader(
            'Content-Type',
            'application/json'
        );
});

$app->run();