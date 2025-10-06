<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Support\Facades\File;

class ChatApiTest extends TestCase{

    private $testFilePath;

    protected function setUp(): void{
        parent::setUp();

        $this->testFilePath = storage_path('app/chat.json');

        $testData = [
            ['question' => 'Què és Laravel?',
             'answer' => 'Laravel es un framework de PHP'
            ],
            ['question' => 'Com instal·lar Laravel?',
             'answer' => 'Pots instal·lar Laravel mitjançant Composer'
            ]
        ];

        File::put($this->testFilePath, json_encode($testData, JSON_PRETTY_PRINT));
    }

    protected function tearDown(): void{
        if(File::exists($this->testFilePath)){
            File::delete($this->testFilePath);
        }

        parent::tearDown();
    }

    /** @test */
    public function it_returns_all_chat_entries(): void{
        $this->assertTrue(File::exists($this->testFilePath), "El fitxer chat.json no existeix.");

        $response = $this->getJson('/api/chat');

        $response->assertStatus(200);
        $response->assertJsonStructure([
            '*' => ['question', 'answer']
        ]);

        $response->assertJsonCount(2);
/* 
        $response->assertJsonFragment([
            'question' => 'Què és Laravel?',
            'answer' => 'Laravel es un framework de PHP'
        ]);

        $response->assertJsonFragment([
            'question' => 'Com instal·lar Laravel?',
            'answer' => 'Pots instal·lar Laravel mitjançant Composer'
        ]); */
    }
}

?>