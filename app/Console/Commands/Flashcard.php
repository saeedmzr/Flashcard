<?php

namespace App\Console\Commands;

use App\Http\Controllers\FlashcardController;
use App\Models\Reply;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Symfony\Component\Console\Helper\Table;
use Symfony\Component\Console\Helper\TableSeparator;


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
                case 'Practice':
                    $this->practice();
                    break;
            }


        }


    }

    public function practice()
    {
        $table = new Table($this->output);

        // Set the table headers.
        $table->setHeaders([
            'Question', 'Status'
        ]);

        // Create a new TableSeparator instance.
        $separator = new TableSeparator;

        // Set the contents of the table.
        $flashcards = \App\Models\Flashcard::all();
        foreach ($flashcards as $flashcard) $table->addRow(['Question' => $flashcard->question, 'Status' => $flashcard->status], $separator);
        $table->render();

        $question = $this->choice('Wich Question do you want to practice ?'
            , $flashcards->pluck('question')->toArray());

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
        $table = new Table($this->output);

        // Set the table headers.
        $table->setHeaders([
            'Question', 'Answer'
        ]);

        // Create a new TableSeparator instance.
        $separator = new TableSeparator;

        // Set the contents of the table.
        $flashcards = \App\Models\Flashcard::all();
        foreach ($flashcards as $flashcard) $table->addRow(['Question' => $flashcard->question, 'Answer' => $flashcard->answer], $separator);
        $table->render();
    }
}
