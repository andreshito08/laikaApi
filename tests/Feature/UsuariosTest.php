<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UsuariosTest extends TestCase
{
    public function testgetUsuarios()
    {
        $this->json('GET', 'api/usuarios')
            ->assertStatus(200)
            ->assertJsonStructure([[
                "id",
                "identificacion",
                "nombre",
                "apellidos",
                "email",
                "tipo_identificacion_cod",
                "tipo_identificacion",
            ]]);
    }

    public function testgetUsuario()
    {
        $this->json('GET', 'api/usuarios/50')
            ->assertStatus(200)
            ->assertJsonStructure([
                "id",
                "nombre",
                "identificacion",
                "apellidos",
                "email",
                "tipo_identificacion_cod",
                "tipo_identificacion",
            ]);
    }

    public function testGuardarUsuario()
    {
        $datos = [
            "nombre" => "Test",
            "identificacion" => "1174147243",
            "apellidos" => "Zapata",
            "email" => "",
            "tipo_identificacion_cod" => "4"
        ];

        $this->json('POST', 'api/usuarios', $datos)
            ->assertStatus(201)
            ->assertJsonStructure([
                "mensaje",
                "error"
            ]);
    }

    public function testActualizarUsuario()
    {
        $datos = [
            "id"=>32,
            "nombre" => "Juan adwsd",
            "identificacion" => "10741002",
            "apellidos" => "Zapata eqweqw",
            "email" => "text0011@example13swe3.com",
            "tipo_identificacion_cod" => "4"
        ];

        $this->json('PUT', 'api/usuarios/32', $datos)
            ->assertStatus(200)
            ->assertJsonStructure([
                "mensaje",
                "error"
            ]);
    }

    public function testEliminarUsuario()
    {
        $this->json('DELETE', 'api/usuarios/53')
            ->assertStatus(200)
            ->assertJsonStructure([
                "mensaje",
                "error"
            ]);
    }

}
