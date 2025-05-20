<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class SessionControllerTest extends TestCase
{
    public function testSessionController()
    {
        $this->get('/session/create')
            ->assertSeeText('OK')
            ->assertSessionHas('userId', 'Prama')
            ->assertSessionHas('isMember', 'true');
    }

    public function testGetSession()
    {
        $this->withSession([
            'userId' => 'Prama',
            'isMember' => 'true'
        ])->get('session/get')
            ->assertSeeText('Prama')
            ->assertSeeText('true');
        
    }

    // public function testSessionFailed()
    // {
    //     $this->withSession([])->get('/session/get')
    //         ->assertSeeText('User Id: guest, Is Member: false');
    // }
}
