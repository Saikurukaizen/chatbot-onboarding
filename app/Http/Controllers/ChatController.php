<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class ChatController extends Controller{

    private string $chatbotFile = 'chat.json';

    private function readChatbotFile(): array{
        try{
            $path = storage_path('app/' . $this->chatbotFile);
            if(!file_exists($path)){
                throw new Exception("El fitxer " . $this->chatbotFile . " no existeix");
            }
            
            $content = file_get_contents($path);

            if(json_last_error() !== JSON_ERROR_NONE){
                throw new Exception("Error de format JSON: " . json_last_error_msg());
            }

            return $content ? json_decode($content, true) ?? [] : [];

        }catch(Exception $e){
            Log::error("Hi ha hagut un error al llegir l'arxiu: " . $e->getMessage());
        }
        return [];
    }

    private function writeChatbotFile(array $chat): void{
        try{
            $path = storage_path('app/' . $this->chatbotFile);
            $json = json_encode($chat, JSON_PRETTY_PRINT);

            if($json === false){
                throw new Exception("Error de codificació JSON: " . json_last_error_msg());
            }
            
            file_put_contents($path, $json);
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
