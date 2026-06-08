<?php

require __DIR__ . '/../vendor/autoload.php';

use Slim\Factory\AppFactory;
use Dotenv\Dotenv;
use App\Models\Usuario;

// Cargar .env
$dotenv = Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();

// Conexion BD
require __DIR__ . '/../app/Config/database.php';

// Crear app Slim
$app = AppFactory::create();

$app->addBodyParsingMiddleware();

// Ruta de prueba
$app->get('/usuarios', function ($request, $response) {

    $usuarios = Usuario::all();

    $response->getBody()->write(
        json_encode($usuarios)
    );

    return $response
        ->withHeader('Content-Type', 'application/json');
});

$app->run();