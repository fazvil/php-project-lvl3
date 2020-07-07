<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Faker\Factory;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Http;
use GuzzleHttp\Client;

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
        $response = $this->get(route('index'));
        $response->assertOk();
    }

    public function testStore()
    {
        $faker = Factory::create();
        $url = $faker->url;
        $response = $this->post(route('domains.store'), ['domain' => $url]);
        $response->assertSessionHasNoErrors();
        $response->assertRedirect();

        $this->assertDatabaseHas('domains', [
            'name' => $url
        ]);
    }

    public function testDomainsIndex()
    {
        $faker = Factory::create();
        $this->post(route('domains.store'), ['domain' => $faker->url]);
        $this->post(route('domains.store'), ['domain' => $faker->url]);
        $response = $this->get(route('domains.index'));
        $response->assertOk();

        $this->assertDatabaseCount('domains', 2);
    }
    
    public function testShow()
    {     
        $faker = Factory::create();
        $url = $faker->url;
        $this->post(route('domains.store'), ['domain' => $url]);
        $id = DB::table('domains')->where('name', $url)->value('id');
        $response = $this->get(route('domains.store', ['id', $id]));
        $response->assertOk();
    }
    
    public function testChecks()
    {
        Http::fake();
        $faker = Factory::create();
        $url = $faker->url;
        $this->post('/domains', ['domain' => $url]);
        $id = DB::table('domains')->where('name', $url)->value('id');
        $response = $this->post(route('domains.checks', ['id' => $id]));
        $response->assertSessionHasNoErrors();
        $response->assertRedirect();
    }
}
