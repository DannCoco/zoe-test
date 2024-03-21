<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use App\Models\SecurityType;
use App\Models\Security;
use App\Models\SecurityPrice;

class SecuritiesControllerTest extends TestCase
{
    use RefreshDatabase;
    public function test_get_security_types_list_return_data()
    {
        $securityType = SecurityType::factory()->create([
            "slug" => "hello-world",
            "name" => "Hello World"
        ]);

        $security = Security::factory()->create([
            "security_type_id" => $securityType->id,
            "symbol" => "TSLA"
        ]);

        $response = $this->get('/api/pricing');
        $response->assertStatus(200);
        
        $securityPrice = SecurityPrice::factory()->count(1)->make();
        $securityPrice = SecurityPrice::first();

        $this->assertEquals($security->id, $securityPrice->security_id);
    }

    public function test_get_security_types_list_return_empty()
    {
        $response = $this->get('/api/pricing');
        $response->assertStatus(409);
    }
}
