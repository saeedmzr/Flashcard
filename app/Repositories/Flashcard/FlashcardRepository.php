<?php

namespace App\Repositories\Flashcard;

use App\Models\Flashcard;
use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Model;

class FlashcardRepository extends BaseRepository
{
    protected $model;

    public function __construct(Flashcard $model)
    {
        $this->model = $model;
    }

}
