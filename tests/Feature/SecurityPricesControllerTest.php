<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use App\Models\SecurityType;
use App\Models\Security;
use App\Models\SecurityPrice;

class SecurityPricesControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_security_prices_update()
    {
        $securityType = SecurityType::factory()->create([
            "slug" => "hello-world",
            "name" => "Hello World"
        ]);

        $security = Security::factory()->create([
            "security_type_id" => $securityType->id,
            "symbol" => "TSLA"
        ]);
        
        $securityPriceCurrent = SecurityPrice::factory()->create([
            "security_id" => $security->id,
            "last_price" => 244.49,
            "as_of_date" => now()
        ]);

        $type = $securityType->id;
        $response = $this->get("/api/security-prices/$type");
        $response->assertStatus(200);
        
        $securityPrice = SecurityPrice::factory()->count(1)->make();
        $securityPrice = SecurityPrice::first();

        $this->assertNotEquals($securityPriceCurrent->last_price, $securityPrice->last_price);
    }

    public function test_security_prices_no_updated() 
    {
        $response = $this->get("/api/security-prices/9999");
        $response->assertStatus(400);
    }
}
