<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RoutingTest extends TestCase
{
    public function testGet()
    {
        $this->get('/pzn')
            ->assertStatus(200)
            ->assertSeeText('Prama Hawelayuda');
    }

    public function testRedirect()
    {
        $this->get('/youtube')
            ->assertRedirect('/pzn');
    }

    public function testFallback()
    {
        $this->get('/tidakada')
            ->assertSeeText('404 by Prama');
    }

    public function testRouteParameter()
    {
        $this->get('/products/1')
            ->assertSeeText('Product 1');
        
        $this->get('/products/2')
            ->assertSeeText('Product 2');

        $this->get('/products/1/items/XXX')
            ->assertSeeText('Product 1, Item XXX');
        
        $this->get('/products/2/items/YYY')
            ->assertSeeText('Product 2, Item YYY');
    }

    public function testRouteParameterRegex()
    {
        $this->get('/categories/100')
            ->assertSeeText('Category 100');

        $this->get('/categories/Prama')
            ->assertSeeText('404 by Prama');
    }

    public function testRouteParameterOptional() 
    {
        $this->get('/users/prama')
            ->assertSeeText('User prama');

        $this->get('/users/')
            ->assertSeeText('User 404');
        
    }

    public function testRouteConflict()
    {
        $this->get('/conflict/yuda')
        ->assertSeeText('Conflict yuda');
        
        $this->get('/conflict/prama')
        ->assertSeeText('Conflict Prama');
    }

    public function testNamedRoute()
    {
        $this->get('/produk/12345')
            ->assertSeeText('Link http://localhost/products/12345');
        
        $this->get('/produk-redirect/12345')
            ->assertRedirect('/products/12345');
        
    }
}
