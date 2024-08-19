<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    protected $fillable = ['question', 'module_id', 'order'];

    public function module()
    {
        return $this->belongsTo(Module::class);
    }

    public function text_answers()
    {
        return $this->hasMany(TextBoxAnswer::class);
    }

    public function multiple_choice_options()
    {
        return $this->hasMany(MultipleChoiceOption::class);
    }
}
