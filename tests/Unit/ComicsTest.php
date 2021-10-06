<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ComicsTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testListComics()
    {
        $this->withHeader('Authorization', 'Bearer ' . 'foo_bar')->json('GET', '/comics/1168')
            ->assertStatus(200);
    }
}
