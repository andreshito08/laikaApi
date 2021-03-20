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
            "nombre" => "Holawwwww"
        ];

        $this->json('POST', 'api/tipoidentificacion', $datos)
            ->assertStatus(201)
            ->assertJsonStructure([[
                "mensaje",
                "error"
            ]]);
    }
}
