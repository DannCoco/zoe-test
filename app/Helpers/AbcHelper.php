<?php

namespace App\Helpers;

class AbcHelper 
{

    public static function pricing_data($security_type)
    {
        $api = "/securities/prices?type=$security_type";

        return [
            "results" => [
                [
                    "symbol" => "APPL",
                    "price" => 188.95,
                    "last_price_datetime" => "2023-10-30T17:31:18-04:00"
                ],
                [
                    "symbol" => "TSLA",
                    "price" => 244.45,
                    "last_price_datetime" => "2023-10-30T17:32:11-04:00"
                ]
            ]
        ];
    }
    
}


