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
        $this->json('GET', 'api/usuarios/32')
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

    public function testActualizarUsuario()
    {
        $datos = [
            "id"=>11,
            "nombre" => "Juan1",
            "identificacion" => "107413821",
            "apellidos" => "Zapata1",
            "email" => "doe@example13swe3.com",
            "tipo_identificacion_cod" => "4"
        ];

        $this->json('PUT', 'api/usuarios/'.$datos["id"], $datos)
            ->assertStatus(200)
            ->assertJsonStructure([[
                "mensaje",
                "error"
            ]]);
    }

    public function testGuardarUsuario()
    {
        $datos = [
            "nombre" => "Juan",
            "identificacion" => "1074138",
            "apellidos" => "Zapata",
            "email" => "",
            "tipo_identificacion_cod" => "4"
        ];

        $this->json('POST', 'api/usuarios', $datos)
            ->assertStatus(201)
            ->assertJsonStructure([[
                "mensaje",
                "error"
            ]]);
    }

    public function testEliminarUsuario()
    {
        $this->json('DELETE', 'api/usuarios/8')
            ->assertStatus(200)
            ->assertJsonStructure([
                "mensaje",
                "error"
            ]);
    }

}
