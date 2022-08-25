<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class Tweet extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    /**
     * @return BelongsToMany<User>
     */
    public function likes(): BelongsToMany
    {
        return $this->belongsToMany(
            related: User::class,
            table: 'liked_tweets',
        )->withTimestamps();
    }

    /**
     * @return HasMany<Retweet>
     */
    public function retweets(): HasMany
    {
        return $this->hasMany(
            related: Retweet::class,
        );
    }

    /**
     * @return BelongsTo<User,Tweet>
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(
            related: User::class,
            foreignKey: 'user_id',
        );
    }
}
