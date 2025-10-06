<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Support\Facades\Storage;

class ChatbotJsonTest extends TestCase{

    private $chatbotFile = 'chat.json';

    protected function setUp(): void{
        parent::setUp();
        Storage::fake('local')->put($this->chatbotFile, json_encode([
            ['question' => 'Què és Laravel?',
             'answer' => 'Laravel es un framework de PHP'
            ]
        ], JSON_PRETTY_PRINT));
    }

    /** @test */
    public function it_exists_json_file(): void{
        $this->assertTrue(Storage::disk('local')->exists($this->chatbotFile));
    }

    /** @test */
    public function it_can_read_json_file(): void{
        $content = Storage::disk('local')->get($this->chatbotFile);
        $this->assertJson($content);
    }

    /** @test */
    public function it_returns_correct_answer(): void{
        $content = Storage::disk('local')->get($this->chatbotFile);
        $data = json_decode($content, true);
        $this->assertTrue(isset($data[0]['question']) && isset($data[0]['answer']));
        $this->assertFalse(empty($data[0]['question']) || empty($data[0]['answer']));

        $this->assertFalse($data[0]['question'] === $data[0]['answer']);

    }

    /** @test */
    public function it_question_and_answer_are_different(): void{
        $content = Storage::disk('local')->get($this->chatbotFile);
        $data = json_decode($content, true);

        foreach($data as $entry){
            $this->assertFalse($entry['question'] === $entry['answer']);
        }
    }
}

?>