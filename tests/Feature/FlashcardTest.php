<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class FlashcardTest extends TestCase
{
    use RefreshDatabase;

    public function test_records_can_be_created()
    {
        // Run the DatabaseSeeder...
        $this->seed();

    }

    public function test_flashcard_interactive()
    {
        $this->artisan('flashcard:interactive')
            ->expectsChoice('Choose your action ', 'Create a flashcard', ['Create a flashcard', 'List all flashcards', 'Practice', 'Stats', 'Reset', 'Exit'])
            ->expectsQuestion('What is your question?', 'something')
            ->expectsQuestion('What is your answer?', 'something');
    }
}
