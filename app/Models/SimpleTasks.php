<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SimpleTasks extends Model
{
    protected $fillable = [
        'user_id',
        'title',
        'status',
    ];

    /**
     * Get the owner user data.
     *
     * @return BelongsTo
     */
    public function owner(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
