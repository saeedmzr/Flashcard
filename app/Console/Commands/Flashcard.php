<?php

namespace App\Console\Commands;

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

        $option = $this->choice(
            'Choose your action ',
            ['Create a flashcard', 'List all flashcards', 'Practice', 'Stats', 'Reset', 'Exit']
        );

        echo $option ;
        

        switch ($option) {
            case 'Create a flashcard' :
                Artisan::call('flashcard:create');

        }


    }
}
