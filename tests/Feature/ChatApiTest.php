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
    }

    /** @test */
    public function it_stores_new_chat_entry(): void{
        $newEntry = [
            'question' => 'Què és PHP?',
            'answer' => 'PHP es una llenguatge de programació web'
        ];

        $response = $this->postJson('/api/chat', $newEntry);

        $response->assertStatus(201);
        $response->assertJson([
            'message' => 'Chat entry saved successfully'
        ]);
    }

    /** @test */
    public function it_validates_required_fields(): void{
        $invalidData = ['question' => ''];

        $response = $this->postJson('/api/chat', $invalidData);

        $response->assertStatus(422);
        $response->assertJsonValidationErrors(['question', 'answer']);
    }

    /** @test  */
    public function it_creates_a_new_entry(): void{
        $newEntry = [
            'question' => 'Amb quin nom es coneix les dependències de PHP?',
            'answer' => 'Es coneix com a Composer'
        ];

        $response = $this->postJson('/api/chat', $newEntry);
        $response->assertStatus(201);
        $response->assertJson([
            'message' => 'Chat entry saved successfully'
        ]);
    }
}

?>