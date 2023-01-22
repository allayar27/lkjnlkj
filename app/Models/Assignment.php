<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Assignment extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'due_date',
        'file',
        'lesson_id',
    ];

    public function lesson()
    {
        return $this->belongsTo(Lesson::class);
    }



    public function response()
    {
        return $this->hasMany(Response::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class)->whereNull('parent_id');
    }

    protected $casts = [
        'created_at' => 'datetime:d/m/Y H:i:s'
    ];

}
