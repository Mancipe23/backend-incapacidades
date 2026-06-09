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

        $response->getBody()->write(
            json_encode([
                'mensaje' => 'Login correcto',
                'usuario' => $usuario
            ])
        );

        return $response
            ->withHeader(
                'Content-Type',
                'application/json'
            );
    }
}