<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

use function PHPUnit\Framework\assertEquals;

class FilteStorageTest extends TestCase
{
    public function testStorage()
    {
        $filesystem = Storage::disk('local');

        $filesystem->put('file.txt', 'Prama Hawelayuda');

        $content = $filesystem->get('file.txt');

        assertEquals('Prama Hawelayuda', $content);
    }

    public function testPublic()
    {
        $filesystem = Storage::disk('public');

        $filesystem->put('file.txt', 'Prama Hawelayuda');

        $content = $filesystem->get('file.txt');

        assertEquals('Prama Hawelayuda', $content);
    }
}
