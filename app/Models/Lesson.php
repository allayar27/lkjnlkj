<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Lesson extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'image',
        'video',
        'category_id'
    ];


    public function assignments()
    {
        return $this->hasMany(Assignment::class);
    }

    public function additionals()
    {
        return $this->hasMany(Additional::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    protected $casts = [
        'created_at' => 'datetime:d/m/Y H:i:s'
    ];
}
