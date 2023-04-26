<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'assignment_id',
        'message',
        'parent_id'
    ];

    public function user():BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function assignment():BelongsTo
    {
        return $this->belongsTo(Assignment::class);
    }

    public function replies()
    {
        return $this->hasMany(Comment::class, 'parent_id');
    }


}
