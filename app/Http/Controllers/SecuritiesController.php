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

class SecuritiesController extends Controller
{
    public function __invoke()
    {
        $securityTypes = SecurityType::all();

        if ($securityTypes->count() == 0) {
            return response("No security type founded", 409);
        }

        $securityTypes->each(function ($securityType) {
            $data = collect(AbcHelper::pricing_data($securityType->slug)["results"]);

            if (!empty($data)) {
                $data->each(function ($pricing) use ($securityType) {
                    $security = Security::where("security_type_id", $securityType->id)->where("symbol", $pricing["symbol"])->first();

                    if ($security instanceof Security) {
                        $asOfDate = date("Y-m-d H:i:s", strtotime($pricing["last_price_datetime"]));

                        SecurityPrice::updateOrCreate(
                            ["security_id" => $security->id],
                            ["security_id" => $security->id, "last_price" => $pricing["price"], "as_of_date" => $asOfDate]
                        );
                    }
                });

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
