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
}

?>