<?php

namespace App\Http\Services;

use Illuminate\Support\Facades\Http;

class UltraMsgService
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
        $url = "https://api.ultramsg.com/instance{$this->instance}/messages/chat";

        $response = Http::asForm()->post($url, [
            'token' => $this->token,
            'to'    => $to,      // e.g., 1234567890
            'body'  => $message,
        ]);

        return $response->json();
    }

    public function sendBulk($numbers, $message)
    {
        $results = [];
        $uniqueNumbers = $numbers->pluck('phone')->unique();

        foreach ($uniqueNumbers as $phone) {
            $results[$phone] = $this->sendMessage($phone, $message);
            usleep(200000);
        }

        return $results;
    }
}
