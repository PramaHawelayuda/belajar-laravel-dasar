<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class URLGenerationTest extends TestCase
{
    public function testURLGeneration()
    {
        $this->get('/url/current?name=Prama')
            ->assertSeeText('/url/current?name=Prama');
    }

    public function testNamed()
    {
        $this->get('/redirect/named')
            ->assertSeeText('/redirect/name/Prama');
    }

    public function testAction()
    {
        $this->get('/url/action')
            ->assertSeeText('/form');
    }
}
