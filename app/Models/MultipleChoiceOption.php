<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MultipleChoiceOption extends Model
{
    use HasFactory;

    protected $fillable = ['option_text', 'correct', 'question_id'];

    public function question()
    {
        return $this->belongsTo(Question::class);
    }
}
