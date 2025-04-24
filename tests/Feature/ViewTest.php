<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ViewTest extends TestCase
{
    public function testView()
    {
        $this->get('/hello')
            ->assertSeeText('Hello Prama');

        $this->get('/hello-againt')
            ->assertSeeText('Hello Prama');
    }

    public function testNested()
    {
        $this->get('/hello-world')
            ->assertSeeText('Hello Prama');
    }

    public function testTemplate()
    {
        $this->view('hello', ['name' => 'Prama'])
            ->assertSeeText('Hello Prama');

        $this->view('hello.world', ['name' => 'Prama'])
            ->assertSeeText('Hello Prama');
    }
}
