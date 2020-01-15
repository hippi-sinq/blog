<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @method static find(int $commentId)
 */
class Comment extends Model
{
    protected $fillable = [
        'comment'
    ];

    public function user(): BelongsTo{
        return $this->belongsTo(User::class);
    }
     public function post(): BelongsTo{
        return $this->belongsTo(Post::class);
     }
}
