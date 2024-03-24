<?php

namespace App\Handler;

use App\Models\User;
use App\Models\Product;
use App\Models\WebhookUrl;
use Spatie\WebhookClient\Jobs\ProcessWebhookJob;
use Spatie\WebhookServer\WebhookCall;
use Illuminate\Support\Str;
use Exception;

class WebhookHandler extends ProcessWebhookJob
{
    public function handle()
    {
       try{
        logger('Webhook call started.');
        $payload = json_decode($this->webhookCall, true)['payload'];
        logger($payload);

        foreach($payload as $item){
            logger('item is');
            logger($item);
            $existingUser=Product::where('code',$item['code'])->first();
          if($existingUser){
                if(isset($item['update'])){
                    $this->updateProduct($existingUser,$item);
                }else{
                   $this-> deleteProduct($existingUser,$item);
                }
               
          }else{
            $this->createProduct($item);
          }
         
        }

       }catch(Exception $e){
     logger($e->getMessage());

       }
    }

    // method for creating new product
    protected function createProduct($count)
    {
        logger("create product");
        try {
            if (isset($count['code'])) {
                $data = new Product;
               
                $data->code = $count['code'];
                $data->name = $count['name'];
                $data->quantity = $count['quantity'];
                $data->price = $count['price'];
                $data->description = $count['description'];
                $data->save();

                $url=WebhookUrl::all();
                foreach( $url as $i ){
                    if($count['crudUrl']===$i->from_url){
                        WebhookCall::create()
                        ->url($i->to_url.'/webhooks') // url of the webhook server
                        ->payload([$data])
                        ->useSecret('two')
                        ->dispatch();
                    }else{
                        WebhookCall::create()
                        ->url($i->from_url.'/webhooks') // url of the webhook server
                        ->payload([$data])
                        ->useSecret('two')
                        ->dispatch();
                    }
                }
                
            } else {
                logger("else part");
            }
        } catch (Exception $e) {
            logger("Webhook failed for create product");
            logger($e->getMessage());
        }
    }

    // method for updating existing user
    protected function updateProduct($data, $count)
    {
        logger("update product");
        logger($count);
        try {
           
            $data->code = $count['code'];
            $data->name = $count['name'];
            $data->quantity = $count['quantity'];
            $data->price = $count['price'];
            $data->description = $count['description'];
            $data->save();

            $url=WebhookUrl::all();
            foreach( $url as $i ){
                if($count['crudUrl']===$i->from_url){
                    WebhookCall::create()
                    ->url($i->to_url.'/webhooks') // url of the webhook server
                    ->payload([$data])
                    ->useSecret('two')
                    ->dispatch();
                }else{
                    WebhookCall::create()
                    ->url($i->from_url.'/webhooks') // url of the webhook server
                    ->payload([$data])
                    ->useSecret('two')
                    ->dispatch();
                }
            }

        } catch (Exception $e) {
            logger("webhook fail for update product");
            logger($e->getMessage());
        }
    }

    // method for deleting existing user
    protected function deleteProduct($data,$count)
    {
        logger("delete product");
        $result = $data->delete();
        $url=WebhookUrl::all();
        foreach( $url as $i ){
            if($count['crudUrl']===$i->from_url){
                WebhookCall::create()
                ->url($i->to_url.'/webhooks') // url of the webhook server
                ->payload([["key"=>1,"code"=>$data->code]])
                ->useSecret('two')
                ->dispatch();
            }else{
                WebhookCall::create()
                ->url($i->from_url.'/webhooks') // url of the webhook server
                ->payload([["key"=>1,"code"=>$data->code]])
                ->useSecret('two')
                ->dispatch();
            }
        }
        // WebhookCall::create()
        //             ->url('http://127.0.0.1:8002/webhooks') // url of the webhook server
        //             ->payload([["key"=>1,"code"=>$data->code]])
        //             ->useSecret('two')
        //             ->dispatch();

        if ($result) {
            logger("data deleted successfully");
        } else {
            logger("Error to deleted the data");
        }
    }
}