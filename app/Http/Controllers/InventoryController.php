<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class InventoryController extends Controller
{
    public function index()
    {
        return view('welcome');
    }

    public function analyze(Request $request)
    {
        $request->validate([
            'inventory_list' => 'required|string',
            'room_image' => 'required|image|max:10240', // Max 10MB
        ]);

        try {
            // 1. Prepare Image
            $imagePath = $request->file('room_image')->getRealPath();
            $imageData = base64_encode(file_get_contents($imagePath));
            $mimeType = $request->file('room_image')->getMimeType();

            // 2. Prepare API Request
            $apiKey = env('GEMINI_API_KEY');
            
            $apiUrl = "https://generativelanguage.googleapis.com/v1beta/models/gemini-3-flash-preview:generateContent"; 

            $prompt = "
                Analyze the provided image (a room or storage space) and the following inventory list: 
                '{$request->inventory_list}'.
                
                For each item in the list, determine the best placement in the image.
                Consider physics and logic: Heavy items go on the bottom/floor. Fragile items go on top or secure areas.
                
                Output PURE JSON with this schema:
                {
                    \"recommendations\": [
                        {
                            \"item_name\": \"Name of item\",
                            \"box_2d\": [ymin, xmin, ymax, xmax], // Scale 0 to 1000
                            \"reasoning\": \"Why this spot? (e.g. Heavy item on floor)\",
                            \"type\": \"heavy|fragile|normal\"
                        }
                    ]
                }
            ";

            $response = Http::timeout(90) // 90 detik
            ->withHeaders([
                'Content-Type' => 'application/json',
                'x-goog-api-key' => $apiKey,
            ])->post($apiUrl, [
                'system_instruction' => [
                    'parts' => [
                        ['text' => "You are LogiVision, an expert logistics AI. You output strictly JSON."]
                    ]
                ],
                'contents' => [
                    [
                        'parts' => [
                            ['text' => $prompt],
                            [
                                'inline_data' => [
                                    'mime_type' => $mimeType,
                                    'data' => $imageData
                                ]
                            ]
                        ]
                    ]
                ],
                'generationConfig' => [
                    'response_mime_type' => 'application/json'
                ]
            ]);

            if ($response->failed()) {
                Log::error('Gemini API Error: ' . $response->body());
                return back()->with('error', 'API Error: ' . $response->json('error.message', 'Unknown error'));
            }

            $responseData = $response->json();
            
            // Parse the JSON content from the candidate
            $textResponse = $responseData['candidates'][0]['content']['parts'][0]['text'] ?? '{}';
            $recommendations = json_decode($textResponse, true);

            return view('welcome', [
                'image' => $imageData,
                'mime_type' => $mimeType,
                'recommendations' => $recommendations['recommendations'] ?? [],
                'inventory_list' => $request->inventory_list
            ]);

        } catch (Exception $e) {
            Log::error($e);
            return back()->with('error', 'Something went wrong: ' . $e->getMessage());
        }
    }
}
