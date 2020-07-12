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
    use RefreshDatabase;

    protected $faker;

    public function setUp() : void
    {
        parent::setUp();
        $this->faker = Factory::create();
    }

    public function testMainIndex()
    {
        $this->get(route('index'))->assertOk();
    }
    
    public function testDomainStore()
    {
        $url = $this->faker->url;
        $response = $this->post(route('domains.store'), ['domainName' => $url]);

        $response->assertSessionHasNoErrors();
        $response->assertRedirect();

        $this->assertDatabaseHas('domains', [
            'name' => $url
        ]);
    }

    public function testDomainsIndex()
    {
        $this->post(route('domains.store'), ['domainName' => $this->faker->url]);
        $this->post(route('domains.store'), ['domainName' => $this->faker->url]);

        $response = $this->get(route('domains.index'));
        $response->assertOk();

        $this->assertDatabaseCount('domains', 2);
    }
    
    public function testDomainShow()
    {
        $url = $this->faker->url;
        $this->post(route('domains.store'), ['domainName' => $url]);

        $id = DB::table('domains')->where('name', $url)->value('id');
        $response = $this->get(route('domains.store', ['id', $id]));

        $response->assertOk();
    }
    
    public function testDomainCheck()
    {
        $url = $this->faker->url;
        $testHtml = file_get_contents(__DIR__ . '/../fixtures/test.html');

        Http::fake([
            $url => Http::response($testHtml, 200)
        ]);

        $this->post(route('domains.store'), ['domainName' => $url]);

        $id = DB::table('domains')->where('name', $url)->value('id');
        $response = $this->post(route('domains.checks', ['id' => $id]));

        $response->assertSessionHasNoErrors();
        $response->assertRedirect();

        $this->assertDatabaseHas('domain_checks', [
            'h1' => 'test h1',
            'description' => 'test description'
        ]);
    }
}
