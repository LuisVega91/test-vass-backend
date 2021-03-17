<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProductoControllerTest extends TestCase
{

    public function test_get_index()
    {
        $response = $this->getJson('/api/productos');
        $response->assertJsonFragment(['success' => true]);
        $response->assertStatus(200);
    }
}
