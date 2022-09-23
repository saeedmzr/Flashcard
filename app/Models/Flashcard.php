<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Flashcard extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $appends = ['status'];

    public function reply()
    {
        return $this->hasOne(Reply::class);
    }

    public function getStatusAttribute()
    {
        if (!$this->reply) return 'Not answered';
        elseif (!$this->reply->is_correct) return 'Incorrect';
        else return 'Correct';
    }
}
