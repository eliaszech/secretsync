<?php

namespace App\Models\Data;

use App\Models\User;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Message extends Model
{
    use HasFactory, HasUuids;


    protected $guarded = [];

    protected $with = [
        'user'
    ];

    public function user(): BelongsTo {
        return $this->belongsTo(User::class);
    }
}
