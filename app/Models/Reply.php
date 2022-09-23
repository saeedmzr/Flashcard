<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reply extends Model
{

    use HasFactory;

    protected $guarded = [];

    public function flashcard()
    {
        return $this->belongsTo(Flashcard::class);
    }


}
