<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Storage;

class ChatController extends Controller{

    private string $chatbotFile = 'storage/app/chat.json';

    public function index(): JsonResponse{

        $chat = $this->readChatbotFile();
        return response()->json($chat);
    }

    public function store(Request $request): JsonResponse{
        $validated = $request->validate([
            'answer' => 'required|string',
            'question' => 'required|string',
        ]);

        $chat = $this->readChatbotFile();
        $chat[] = $validated;

        $this->writeChatbotFile($chat);

        return response()->json([
            'message' => 'Chat entry saved successfully'
        ], 201);
    }

    private function readChatbotFile(): array{
        if(!file_exists($this->chatbotFile)){
            return [];
        }

        $content = file_get_contents($this->chatbotFile);
        return json_decode($content, true) ?? [];
    }

    private function writeChatbotFile(array $chat): void{

        $path = storage_path($this->chatbotFile);

        file_put_contents($path, json_encode($chat, JSON_PRETTY_PRINT));
    }
    //
}
