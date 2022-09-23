<?php

namespace App\Repositories\Flashcard;

use App\Models\Flashcard;
use App\Models\Reply;
use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Model;

class FlashcardRepository extends BaseRepository
{
    protected $model;

    public function __construct(Flashcard $model)
    {
        $this->model = $model;
    }

    public function accuracy(): float|int
    {
        $a = Flashcard::all()->count();
        $b = Reply::query()->where('is_correct', true)->count();

//        avoid division by zero
        if ($a == 0) return 0;

        return ($b / $a) * 100;
    }

    public function getPercentageOfHowManyQuestionsHaveAnswer(): float|int
    {
        $a = Flashcard::all()->count();
        $b = Flashcard::query()->whereHas('reply')->count();

//        avoid division by zero
        if ($a == 0) return 0;

        return ($b / $a) * 100;
    }


}
