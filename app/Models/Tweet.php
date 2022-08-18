<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

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
