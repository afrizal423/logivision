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
            $selectedLang = $request->input('language', 'en');
            $langNames = [
                'en' => 'English (US)',
                'id' => 'Indonesian',
                'ja' => 'Japanese',
                'zh' => 'Chinese',
                'es' => 'Spanish'
            ];
            $langName = $langNames[$selectedLang] ?? 'English (US)';
            
            $apiUrl = "https://generativelanguage.googleapis.com/v1beta/models/gemini-3-flash-preview:generateContent"; 

            $prompt = "
                Analyze the provided image (a room or storage space) and the following inventory list: 
                '{$request->inventory_list}'.
                
                Task 1: Determine the best placement for the inventory items based on physics and logic (Heavy=bottom, Fragile=top).
                Task 2: Safety Audit. Identify potential safety hazards in the current room setup (e.g., liquids near electronics, blocked exits, precarious stacking, trip hazards).

                IMPORTANT: Your output 'reasoning', 'description', 'severity', and 'item_name' MUST be in the {$langName} language.

                Output PURE JSON with this schema:
                {
                    \"placements\": [
                        {
                            \"item_name\": \"Name of item\",
                            \"box_2d\": [ymin, xmin, ymax, xmax], // Scale 0 to 1000
                            \"reasoning\": \"Why this spot?\",
                            \"type\": \"heavy|fragile|normal\",
                            \"utilization_score\": 50 // Integer 0-100. Estimate percentage fullness of this specific shelf/area AFTER placing this item.
                        }
                    ],
                    \"hazards\": [
                        {
                            \"description\": \"Description of the hazard\",
                            \"severity\": \"High|Medium\",
                            \"box_2d\": [ymin, xmin, ymax, xmax] // Scale 0 to 1000 location of the hazard
                        }
                    ]
                }
            ";

            $response = Http::withHeaders([
                'Content-Type' => 'application/json',
                'x-goog-api-key' => $apiKey,
            ])->post($apiUrl, [
                'system_instruction' => [
                    'parts' => [
                        ['text' => "You are LogiVision, an expert logistics AI and Safety Auditor. You output strictly JSON."]
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
            $parsedData = json_decode($textResponse, true);

            return view('welcome', [
                'image' => $imageData,
                'mime_type' => $mimeType,
                'recommendations' => $parsedData['placements'] ?? [], // Map 'placements' to 'recommendations' to keep view compatible
                'hazards' => $parsedData['hazards'] ?? [],
                'inventory_list' => $request->inventory_list
            ]);

        } catch (Exception $e) {
            Log::error($e);
            return back()->with('error', 'Something went wrong: ' . $e->getMessage());
        }
    }
}
