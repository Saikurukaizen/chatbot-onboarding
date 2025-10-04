<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class Chatbot extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'chatbot:start';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Start CLI Chatbot';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        if(!Storage::exists('chat.json')){
            $this->error("El fitxer chat.json no existeix.");
            return Command::FAILURE;
        }

        $chat = json_decode(Storage::get('chat.json'), true);

        if(!is_array($chat) || empty($chat)){
                $this->error("El fitxer està buit o no es vàlid.");
                return Command::FAILURE;
            }

        do{
            $this->line("En què et puc ajudar? Escriu el número de la pregunta! (pulsa 0 per sortir):");
           
            foreach($chat as $key => $value){
                $this->line(($key + 1) . ". " . $value['question']);
            }
            $this->line("0. Sortir");

            $userInput = readline("Tu: "); 

            if(!is_numeric($userInput)){
                $this->error("Si us plau, introdueix un número vàlid.");
                continue;
            }

            $userInput = (int) $userInput; 

            switch($userInput){
                case 1:
                    $this->line("Tu: " . $chat[0]['question']);
                    $this->info($chat[0]['answer']);
                    $this->line("Torna a preguntar! Pulsa una tecla per continuar.");
                    readline();
                    break;

                case 2:
                     $this->line("Tu: " . $chat[1]['question']);
                    $this->info($chat[1]['answer']);
                    $this->line("Torna a preguntar! Pulsa una tecla per continuar.");
                    readline();
                    break;
                case 3:
                     $this->line("Tu: " . $chat[2]['question']);
                    $this->info($chat[2]['answer']);
                    $this->line("Torna a preguntar! Pulsa una tecla per continuar.");
                    readline();
                    break;
                case 4:
                     $this->line("Tu: " . $chat[3]['question']);
                    $this->info($chat[3]['answer']);
                    $this->line("Torna a preguntar! Pulsa una tecla per continuar.");
                    readline();
                    break;
                case 5:
                     $this->line("Tu: " . $chat[4]['question']);
                    $this->info($chat[4]['answer']);
                    $this->line("Torna a preguntar! Pulsa una tecla per continuar.");
                    readline();
                    break;
                case 6:
                     $this->line("Tu: " . $chat[5]['question']);
                    $this->info($chat[5]['answer']);
                    $this->line("Torna a preguntar! Pulsa una tecla per continuar.");
                    readline();
                    break;
                case 7:
                     $this->line("Tu: " . $chat[6]['question']);
                    $this->info($chat[6]['answer']);
                    $this->line("Torna a preguntar! Pulsa una tecla per continuar.");
                    readline();
                    break;
                case 8:
                     $this->line("Tu: " . $chat[7]['question']);
                    $this->info($chat[7]['answer']);
                    $this->line("Torna a preguntar! Pulsa una tecla per continuar.");
                    readline();
                    break;
                case 9:
                    $this->line("Tu: " . $chat[8]['question']);
                    $this->info($chat[8]['answer']);
                    $this->line("Torna a preguntar! Pulsa una tecla per continuar.");
                    readline();
                    break;
                case 0:
                    $this->info("Fins aviat!");
                    break;
                default:
                    $this->error("Opciò no vàlida. Introdueix un nùmero correcte.");
                    break;
            }
        } while($userInput != 0);

        return Command::SUCCESS;
    }        
}
