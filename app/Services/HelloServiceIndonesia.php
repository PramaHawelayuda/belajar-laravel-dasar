<?php

namespace app\Services;


class HelloServiceIndonesia implements HelloService
{
    public function hello(string $name): string
    {
        return "Hello $name";
    }
}