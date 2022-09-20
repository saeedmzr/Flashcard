<?php

namespace App\Console\Commands;

use App\Http\Controllers\FlashcardController;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class Flashcard extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'flashcard:interactive';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        while (true) {
            $option = $this->choice(
                'Choose your action ',
                ['Create a flashcard', 'List all flashcards', 'Practice', 'Stats', 'Reset', 'Exit']
            );


            switch ($option) {
                case 'Create a flashcard' :
                    $this->create();
                    break;
                case 'List all flashcards' :
                    $this->list();
                    break;
            }


        }


    }

    public function create()
    {
        $question = $this->ask('What is your question?');
        $answer = $this->ask('What is your answer ?');

        $flashcard_controller = new FlashcardController();
        $flashcard_controller->createFlashcardByCommand($question, $answer);
    }

    public function list()
    {
        $flashcards = \App\Models\Flashcard::all();
        foreach ($flashcards as $flashcard) echo $flashcard->question . ' : ' . $flashcard->answer . PHP_EOL;
    }
}
