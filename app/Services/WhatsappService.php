<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class WhatsappService
{
    protected $token;
    protected $phoneId;

    public function __construct()
    {
        $this->token = env('WA_TOKEN');
        $this->phoneId = env('WA_PID');
    }

    public function sendMessage($to, $message)
    {
        $url = "https://graph.facebook.com/v22.0/{$this->phoneId}/messages";
        

        return Http::withToken($this->token)->post($url, [
            'messaging_product' => 'whatsapp',
            'recipient_type' => 'individual',
            'to' => $to,
            'type' => 'text',
            'text' => [
                'preview_url' => false,
                'body' => $message
            ],
        ]);
    }
}
