<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Additional extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'media',
        'lesson_id'
    ];

    public function lesson():BelongsTo
    {
        return $this->belongsTo(Lesson::class);
    }
}
