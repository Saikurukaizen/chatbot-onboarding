<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Support\Facades\Storage;

class ChatApiTest extends TestCase{

    /**@test */
    public function it_returns_all_chat_entries(): void{

        $testData = [
            ['question' => 'Què és Laravel?',
             'answer' => 'Laravel es un framework de PHP'
            ],
            ['question' => 'Com instal·lar Laravel?',
             'answer' => 'Pots instal·lar Laravel mitjançant Composer'
            ]
        ];

        Storage::fake('local')->put('chat.json', json_encode($testData, JSON_PRETTY_PRINT));

        $response = $this->getJson('/api/chat');

        $response->assertStatus(200);
        $response->assertJsonStructure([
            '*' => ['question', 'answer']
        ]);

        $response->assertJsonCount(2);
        
        $response->assertJsonFragment([
            'question' => 'Què és Laravel?',
            'answer' => 'Laravel es un framework de PHP'
        ]);

        $response->assertJsonFragment([
            'question' => 'Com instal·lar Laravel?',
            'answer' => 'Pots instal·lar Laravel mitjançant Composer'
        ]);
    }
}

?>