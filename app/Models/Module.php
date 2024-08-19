<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Module extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description', 'course_id', 'order', 'media_link'];

    public function chapter()
    {
        return $this->belongsTo(Chapter::class);
    }
}
