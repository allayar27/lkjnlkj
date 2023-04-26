<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Response extends Model
{
    use HasFactory;

    protected $fillable = [
        'file',
        'title',
        'assignment_id',
        'user_id'
    ];



    public function assignment():BelongsTo
    {
        return $this->belongsTo(Assignment::class);
    }

    public function user():BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    protected $casts = [
        'created_at' => 'datetime:d/m/Y H:i:s'
    ];

}
