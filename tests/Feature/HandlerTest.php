<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Faker\Factory;
use Illuminate\Support\Facades\DB;

class HandlerTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    use RefreshDatabase;

    public function testIndex()
    {
        $response = $this->get('/');
        $response->assertOk();
    }

    public function testStore()
    {
        $faker = Factory::create();
        $url = $faker->url;
        $response = $this->post('/domains', ['domain' => $url]);
        $response->assertSessionHasNoErrors();
        $response->assertRedirect();
        $this->assertDatabaseHas('domains', [
            'name' => $url
        ]);
    }

    public function testDomainsIndex()
    {
        $faker = Factory::create();
        $this->post('/domains', ['domain' => $faker->url]);
        $this->post('/domains', ['domain' => $faker->url]);
        $response = $this->get('/domains');
        $response->assertOk();
        $this->assertDatabaseCount('domains', 2);
    }
    
    public function testShow()
    {
        
        $faker = Factory::create();
        $url = $faker->url;
        $this->post('/domains', ['domain' => $url]);
        $id = DB::table('domains')->where('name', $url)->value('id');
        $response = $this->get("/domains/{$id}");
        $response->assertOk();
    }
}
