<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class InputControllerTest extends TestCase
{
    public function testInput()
    {
        $this->get('/input/hello?name=Prama')
            ->assertSeeText('Hello Prama');
        
        $this->post('/input/hello', [
            'name' => 'Prama'
        ])->assertSeeText('Hello Prama');
    }

    public function testInputNasted()
    {
        $this->post('/input/hello/first', [
            "name" => [
                "first" => "Prama",
                "last" => "Hawelayuda"
            ]
        ])->assertSeeText('Hello Prama');
    }
    
    public function testInputAll()
    {
        $this->post('/input/hello/input', [
            "name" => [
                "first" => "Prama",
                "last" => "Hawelayuda"
            ]
        ])->assertSeeText('name')->assertSeeText('first')
            ->assertSeeText('last')->assertSeeText('Prama')
            ->assertSeeText('Hawelayuda');
    }

    public function testArrayInput()
    {
        $this->post('/input/hello/array', [
            'products' => [
                [
                    'name' => 'Apple Mac Book Pro',
                    'price' => 3000000
                ],
                [
                    'name' => 'Samsung Galaxy',
                    'price' => 2000000
                ]
            ]
        ])->assertSeeText('Apple Mac Book Pro')
            ->assertSeeText('Samsung Galaxy');
    }
}
