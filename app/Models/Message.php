<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Message extends Model
{
    use HasFactory;

    protected $fillable = [
        'from',
        'to',
        'body'
    ];

    /**
     * @return HasOne
     */
    public function fromUser(): HasOne
    {
        return $this->hasOne(User::class, 'id', 'from');
    }

    /**
     * @return HasOne
     */
    public function toUser(): HasOne
    {
        return $this->hasOne(User::class, 'id', 'to');
    }
}
