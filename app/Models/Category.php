<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property bool is_active
 * @property mixed name
 * @property mixed id
 */
class Category extends Model
{
    protected $fillable = [
        'name','is_active'

    ];
    public function posts(): HasMany{
        return $this->hasMany(Post::class);
    }
}
