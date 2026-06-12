<?php

namespace App\Controllers;

use App\Models\Usuario;

class AuthController
{
    public function login($request, $response)
    {
        $data = $request->getParsedBody();

        $usuario = Usuario::where(
            'usuario',
            $data['usuario']
        )->first();

        if (!$usuario) {

            $response->getBody()->write(
                json_encode([
                    'mensaje' => 'Usuario no encontrado'
                ])
            );

            return $response
                ->withStatus(404)
                ->withHeader(
                    'Content-Type',
                    'application/json'
                );
        }

        if (
            $usuario->contrasena
            !=
            $data['contrasena']
        ) {

            $response->getBody()->write(
                json_encode([
                    'mensaje' => 'Contraseña incorrecta'
                ])
            );

            return $response
                ->withStatus(401)
                ->withHeader(
                    'Content-Type',
                    'application/json'
                );
        }

        $token = bin2hex(
            random_bytes(32)
        );

        $usuario->token = $token;
        $usuario->sesion_activa = 1;

        $usuario->save();

        $response->getBody()->write(
            json_encode([
                'mensaje' => 'Login correcto',
                'token' => $token,
                'usuario' => $usuario
            ])
        );

        return $response
            ->withHeader(
                'Content-Type',
                'application/json'
            );
    }

    public function logout($request, $response)
{
    $data = $request->getParsedBody();

    $usuario = Usuario::where(
        'token',
        $data['token']
    )->first();

    if (!$usuario) {

        $response->getBody()->write(
            json_encode([
                'mensaje' =>
                    'Token no válido'
            ])
        );

        return $response
            ->withStatus(401)
            ->withHeader(
                'Content-Type',
                'application/json'
            );
    }

    $usuario->token = null;

    $usuario->sesion_activa = 0;

    $usuario->save();

    $response->getBody()->write(
        json_encode([
            'mensaje' =>
                'Sesión cerrada'
        ])
    );

    return $response
        ->withHeader(
            'Content-Type',
            'application/json'
        );
    }
}