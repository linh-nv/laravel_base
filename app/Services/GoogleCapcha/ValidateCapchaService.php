<?php
namespace App\Services\GoogleCapcha;
use GuzzleHttp\Client;
class ValidateCapchaService
{

    public function validate($capcha)
    {
    	$client = new Client();
        $response = $client->post(
            'https://www.google.com/recaptcha/api/siteverify',
            ['form_params'=>
                [
                    'secret'=>config('services.google_capcha.secret'),
                    'response'=>$capcha
                 ]
            ]
        );
        $body = json_decode((string)$response->getBody());
        return $body->success;
    }

}
