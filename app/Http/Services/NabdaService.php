<?php

namespace App\Http\Services;

use Illuminate\Support\Facades\Http;
use GuzzleHttp\Client;

class NabdaService
{
    protected $instance;
    protected $token;

    public function __construct()
    {
        $this->instance = env('ULTRAMSG_INSTANCE_ID');
        $this->token = env('ULTRAMSG_TOKEN');
    }

    /**
     * Send a WhatsApp message
     */
    public function sendMessage($to, $message)
    {
        $client = new Client();
        try {
            $response = $client->request('POST', 'https://api.nabdaotp.com/api/v1/messages/send', [
                'headers' => [
                    'Content-Type' => 'application/json',
                    'Authorization' => 'sk_4382cf0558da428c8ac6ec1c545d5db6'
                ],
                'json' => [
                    'phone' => $to,
                    'message' => $message
                ]
            ]);
            return $response;
        } catch (\Throwable $th) {
            return null;
        }
    }

    public function sendBulk($numbers, $message)
    {
        $results = [];
        $uniqueNumbers = $numbers->pluck('phone')->unique();

        foreach ($uniqueNumbers as $phone) {
            $phone = str_replace(' ', '', $phone);
            // If starts with +9630 → remove the 0
            if (str_starts_with($phone, '+9630')) {
                $phone = '+963' . substr($phone, 5);
            }
            $results[$phone] = $this->sendMessage($phone, $message);
            usleep(100000);
        }

        return $results;
    }
}
