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

    public function sendBulk(array $numbers, $message)
    {
        $results = [];

        foreach ($numbers as $number) {
            $results[$number] = $this->sendMessage($number, $message);
            usleep(200000); // optional delay to prevent hitting API limits (0.2 sec)
        }

        return $results;
    }
}
