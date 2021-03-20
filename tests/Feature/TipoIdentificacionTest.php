<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TipoIdentificacionTest extends TestCase
{

    public function testgetTipoIdent()
    {
        $this->json('GET', 'api/tipoidentificacion')
        ->assertStatus(200)
        ->assertJsonStructure([[
            "id",
            "nombre"
        ]]);
    }

    public function testgetTipoIdentId()
    {
        $this->json('GET', 'api/tipoidentificacion/4')
        ->assertStatus(200)
        ->assertJsonStructure([
            "id",
            "nombre"
        ]);
    }

    public function testGuardarTipoIdent()
    {
        $datos = [
            "nombre" => "MUNDO QWERqw"
        ];

        $this->json('POST', 'api/tipoidentificacion', $datos)
            ->assertStatus(201)
            ->assertJsonStructure([
                "mensaje",
                "error"
            ]);
    }

    public function testActualizarTipoIdent()
    {
        $datos = [
            "id"=>1,
            "nombre" => "TEST WSO"
        ];

        $this->json('PUT', 'api/tipoidentificacion/1', $datos)
            ->assertStatus(200)
            ->assertJsonStructure([
                "mensaje",
                "error"
            ]);
    }

    public function testEliminarTipoIdent()
    {
        $this->json('DELETE', 'api/tipoidentificacion/43')
            ->assertStatus(200)
            ->assertJsonStructure([
                "mensaje",
                "error"
            ]);
    }
}
