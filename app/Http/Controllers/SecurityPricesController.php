<?php

namespace App\Http\Controllers;

use App\Helpers\AbcHelper;
use App\Mail\SampleMail;
use App\Models\Security;
use App\Models\SecurityPrice;
use App\Models\SecurityType;
use Illuminate\Http\Request;

use Log;
use Mail;

class SecurityPricesController extends Controller
{
    public function __invoke($type)
    {
        $securityType = SecurityType::where("id", $type)->first();
        if (!$securityType instanceof SecurityType) {
            return response("No security type found", 400);
        }

        $data = collect(AbcHelper::pricing_data($securityType["slug"])["results"]);

        $data->each(function ($pricing) use ($securityType) {
            $security = Security::where("security_type_id", $securityType->id)->where("symbol", $pricing["symbol"])->first();
            if ($security instanceof Security) {
                SecurityPrice::where("security_id", $security["id"])->update(["last_price" => $pricing["price"]]);
            }
        });

        $content = [
            'subject' => 'Sync finished',
            'body' => 'Price synchronization has completed successfully.'
        ];

        Mail::to('admin.app@zoefin.com')->send(new SampleMail($content));

        Log::info("Email has been sent.");
    }
}
