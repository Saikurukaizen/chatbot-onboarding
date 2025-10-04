<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Support\Facades\Storage;

class ChatApiTest extends TestCase{

    /**@test */
    public function it_returns_all_chat_entries(): void{
        Storage::fake('local')->put('chat.json', json_encode([
            ['question' => 'Què és Laravel?',
             'answer' => 'Laravel es un framework de PHP'
            ]
        ]));

        $response = $this->getJson('/api/chat');
    }
}

?>