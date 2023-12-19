<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Note extends Model
{
    use HasFactory, HasUuids;

    protected $guarded = [
        'id'
    ];

    protected $casts = [
        'is_published' => 'boolean'
    ];

    public function scopePublished($query)
    {
        return $query->where('is_published', '=', true);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
