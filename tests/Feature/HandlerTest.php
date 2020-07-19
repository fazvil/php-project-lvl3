<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Faker\Factory;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class HandlerTest extends TestCase
{
    private $id;
    private $url = 'http://www.youtube.com';

    protected function setUp(): void
    {
        parent::setUp();
        $this->id = DB::table('domains')->insertGetId(
            [
                'name' => $this->url,
                'created_at' => '2020-02-20',
                'updated_at' => '2020-02-20'
            ]
        );
        DB::table('domain_checks')->insert(
            [
                'domain_id' => $this->id,
                'status_code' => 200,
                'h1' => null,
                'keywords' => null,
                'description' => null,
                'created_at' => '2020-02-20',
                'updated_at' => '2020-02-20'
            ]
        );
    }
    
    public function testMainIndex()
    {
        $response = $this->get(route('index'));
        $response->assertOk();
    }

    public function testIndex()
    {
        $response = $this->get(route('domains.index'));
        $response->assertOk();
    }

    public function testStore()
    {
        $url = Factory::create()->url;
        $response = $this->post(route('domains.store'), ['domainName' => $url]);
        $response->assertSessionHasNoErrors();
        $response->assertRedirect();

        $this->assertDatabaseHas('domains', ['name' => $url]);
    }
    
    public function testShow()
    {
        $response = $this->get(route('domains.show', ['id' => $this->id]));
        $response->assertOk();
    }
    
    public function testCheck()
    {
        $testHtml = file_get_contents(__DIR__ . '/../fixtures/test.html');
        Http::fake([
            $this->url => Http::response($testHtml, 200)
        ]);
        $response = $this->post(route('domains.checks', ['id' => $this->id]));
        $response->assertSessionHasNoErrors();
        $response->assertRedirect();

        $this->assertDatabaseHas('domain_checks', [
            'h1' => 'test h1',
            'description' => 'test description'
        ]);
    }
}
