<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Retweet extends Model
{
    protected $guarded = ['id'];

    /**
     * @return BelongsTo<User,Retweet>
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(
            related: User::class,
        );
    }

    /**
     * @return BelongsTo<Tweet,Retweet>
     */
    public function tweet(): BelongsTo
    {
        return $this->belongsTo(
            related: Tweet::class,
        );
    }
}
