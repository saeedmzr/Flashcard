<?php

namespace App\Console\Commands;

use App\Http\Controllers\FlashcardController;
use App\Models\Reply;
use App\Repositories\Flashcard\FlashcardRepository;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use PhpSchool\CliMenu\Dialogue\Flash;
use Symfony\Component\Console\Helper\Table;
use Symfony\Component\Console\Helper\TableSeparator;


class Flashcard extends Command
{
    protected $flashcard_repository;
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

        $option = '';
        $this->flashcard_repository = new FlashcardRepository(new \App\Models\Flashcard());

        while ($option != 'Exit') {
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
                case 'Reset':
                    $this->reset();
                    break;
                case 'Stats':
                    $this->stats();
                    break;
            }


        }


    }

    public function practice()
    {

        $question = '';
        while ($question != 'Stop') {
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
            echo 'Your accuracy is :' . $this->flashcard_repository->accuracy() . '%.';
            $this->newLine(2);

            $choices = $flashcards->pluck('question')->toArray();
            $choices[] = 'Stop';

            $question = $this->choice('Wich Question do you want to practice ?'
                , $choices);

            if ($question != 'Stop') {

                $flashcard = \App\Models\Flashcard::where('question', $question)->first();
                if ($flashcard) {
                    if ($flashcard->reply) {
                        echo 'Your already answered this question.';
                        $this->newLine(2);
                    } else {
                        $answer = $this->ask('Enter Your Answer : ');
                        if ($answer == $flashcard->answer) $is_correct = true;
                        else $is_correct = false;
                        $flashcard->reply()->create(['text' => $answer, 'is_correct' => $is_correct]);
                    }

                }
            }


        }

    }

    public function create()
    {
        $question = $this->ask('What is your question?');
        $answer = $this->ask('What is your answer ?');

        \App\Models\Flashcard::query()->create(['question' => $question, 'answer' => $answer]);
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

    public function reset()
    {
        Reply::query()->delete();
    }

    public function stats()
    {

        echo $this->flashcard_repository->all()->count() . ' : The total amount of questions.';
        $this->newLine(1);
        echo $this->flashcard_repository->getPercentageOfHowManyQuestionsHaveAnswer() . '% of questions that have an answer.';
        $this->newLine(1);
        echo $this->flashcard_repository->accuracy() . '% of questions that have a correct answer.';
        $this->newLine(2);
        $separator = new TableSeparator;
    }
}
