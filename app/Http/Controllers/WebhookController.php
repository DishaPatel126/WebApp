<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\WebhookUrl;
use Illuminate\Http\Request;
use Spatie\WebhookServer\WebhookCall;

class WebhookController extends Controller
{
    public function getWebhook(Request $request)
    {
        $data = $request->all();
        $result = WebhookUrl::create($data);
        
        if ($result) {
          
            WebhookCall::create()
                ->url($request->from_url.'/webhooks')
                ->payload(['to'=>'http://127.0.0.1:8001','from'=>$request->from_url])
                ->useSecret('two')
                ->dispatch();
                WebhookCall::create()
                ->url($request->to_url.'/webhooks')
                ->payload(['to'=>'http://127.0.0.1:8001','from'=>$request->to_url])
                ->useSecret('two')
                ->dispatch();
                return redirect('/dashboard');
        }
    }
}