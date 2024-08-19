<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TextBoxAnswer extends Model
{
    use HasFactory;

    protected $fillable = ['alternative_answer', 'question_id', 'expected_answer', 'is_correct'];

    public function question()
    {
        return $this->belongsTo(Question::class);
    }
}
