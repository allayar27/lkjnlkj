<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Additional extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'media',
        'lesson_id'
    ];

    public function lesson()
    {
        return $this->belongsTo(Lesson::class);
    }
}
