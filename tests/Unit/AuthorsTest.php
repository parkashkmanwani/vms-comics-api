<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AuthorsTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testListAuthors()
    {
        $this->withHeader('Authorization', 'Bearer ' . 'foo_bar')->json('GET', '/authors')
            ->assertStatus(200);
    }
}
