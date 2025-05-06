<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Crypt;
use Tests\TestCase;

use function PHPUnit\Framework\assertEquals;

class EncryptionTest extends TestCase
{
    public function testEcryption()
    {
        $encrypt = Crypt::encrypt('Prama Hawelayuda');
        var_dump($encrypt);

        $decrypt = Crypt::decrypt($encrypt);

        self::assertEquals('Prama Hawelayuda', $decrypt);
    }
}
