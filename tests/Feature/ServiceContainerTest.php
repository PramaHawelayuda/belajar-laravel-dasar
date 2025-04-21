<?php

namespace Tests\Feature;

use App\Data\Foo;
use App\Data\Bar;
use App\Data\Person;
use App\Services\HelloService;
use app\Services\HelloServiceIndonesia;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;


class ServiceContainerTest extends TestCase
{
    public function testDependecy()
    {
        $foo1 = $this->app->make(Foo::class);
        $foo2 = $this->app->make(Foo::class);

        self::assertEquals('Foo', $foo1->foo());
        self::assertEquals('Foo', $foo2->foo());
        self::assertNotSame($foo1, $foo2);
    }   

    public function testBind()
    {
        $this->app->bind(Person::class, function ($app) {
            return new Person("Prama", "Hawelayuda");
        });

        $person1 = $this->app->make(Person::class); //closure() membuat new Person
        $person2 = $this->app->make(Person::class); 

        self::assertEquals('Prama', $person1->firstname);
        self::assertEquals('Prama', $person2->firstname);
        self::assertNotSame($person1, $person2);
    }

    public function testSingleTon()
    {
        $this->app->singleton(Person::class, function ($app) {
            return new Person("Prama", "Hawelayuda");
        });

        $person1 = $this->app->make(Person::class); //closure() membuat new Person
        $person2 = $this->app->make(Person::class); 

        self::assertEquals('Prama', $person1->firstname);
        self::assertEquals('Prama', $person2->firstname);
        self::assertSame($person1, $person2);
    }

    public function testInstance()
    {
        $person = new Person("Prama", "Hawelayuda");
        $this->app->instance(Person::class, $person);

        $person1 = $this->app->make(Person::class); //$person
        $person2 = $this->app->make(Person::class); 

        self::assertEquals('Prama', $person1->firstname);
        self::assertEquals('Prama', $person2->firstname);
        self::assertSame($person1, $person2);
    }

    public function testDepedencyInjection()
    {
        $this->app->singleton(Foo::class, function ($app){
            return new Foo(); 
        });

        $this->app->singleton(Bar::class, function ($app){
            $foo = $app->make(Foo::class);
            return new Bar($foo);
        });

        $foo = $this->app->make(Foo::class);
        $bar1 = $this->app->make(Bar::class);
        $bar2 = $this->app->make(Bar::class);

        self::assertSame($foo, $bar1->foo);

        self::assertSame($bar1, $bar2);
    }

    public function testInterfaceToClass()
    {
        // $this->app->singleton(HelloService::class, HelloServiceIndonesia::class);

        $this->app->singleton(HelloService::class, function ($app){
            return new HelloServiceIndonesia();
        });
        $helloservice = $this->app->make(HelloService::class);

        self::assertEquals('Halo Prama', $helloservice->hello('Prama'));
    }
}
