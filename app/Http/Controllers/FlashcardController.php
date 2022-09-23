<?php

namespace App\Http\Controllers;

use App\Console\Commands\CreateFlashCard;
use App\Models\Flashcard;
use App\Repositories\Flashcard\FlashcardRepository;
use Illuminate\Http\Request;

class FlashcardController extends Controller
{

    public function createFlashcardByCommand($question, $answer)
    {


    }
}
