<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\File;

class ChatController extends Controller{

    private string $chatbotFile = 'chat.json';

    public function setChatbotFile(string $filename): void {
        $this->chatbotFile = $filename;
    }

    private function readChatbotFile(): array{
        try{
            $path = storage_path('app/' . $this->chatbotFile);

            if(!File::exists($path)){
                return [];
            }

            $content = File::get($path);
            return json_decode($content, true) ?? [];

        }catch(Exception $e){
            Log::error("Hi ha hagut un error al llegir l'arxiu: " . $e->getMessage());
        }
        return [];
    }

    private function writeChatbotFile(array $chat): void{
        try{
            $path = storage_path('app/' . $this->chatbotFile);
            $json = json_encode($chat, JSON_PRETTY_PRINT);
            File::put($path, $json);
        } catch(Exception $e){
            Log::error("Error al escriure l'arxiu: " . $e->getMessage());
        }
    }
    
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
}
