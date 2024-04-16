<?php

namespace App\Service;

use GuzzleHttp\Client;

class OpenAIService
{
    public function analyzeSentiment($prompt)
    {
        $apiKey = env('OPENAI_API_KEY');
        $url = "https://api.openai.com/v1/chat/completions";

        $client = new Client();

        try {
            $response = $client->post($url, [
                'headers' => [
                    'Authorization' => 'Bearer ' . $apiKey,
                    'Content-Type' => 'application/json',
                ],
                'json' => [
                    'model' => 'gpt-3.5-turbo-1106',
                    'messages' => [
                        [
                            'role' => 'user',
                            'content' => $prompt
                        ]
                    ]
                ]
            ]);

            $decodedResponse = json_decode($response->getBody(), true);
            $result = $decodedResponse['choices'][0]['message']['content'] ?? 'unknown';

            return $result;
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

}
