<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;

/** @property-read string $profile_photo_url **/
class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int,string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'username',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int,string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string,string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array<int,string>
     */
    protected $appends = [
        'profile_photo_url',
    ];

    /**
     * @return HasMany<Tweet>
     */
    public function tweets(): HasMany
    {
        return $this->hasMany(
            related: Tweet::class,
            foreignKey: 'user_id'
        );
    }

    public function retweet(Tweet $tweet): Retweet
    {
        return $tweet
            ->retweets()
            ->create(['user_id' => $this->id]);
    }

    public function undoRetweet(Tweet $tweet): mixed
    {
        return $tweet
            ->retweets()
            ->where(['user_id' => $this->id])
            ->delete();
    }

    public function hasRetweeted(Tweet $tweet): bool
    {
        return Retweet::query()->where(
            [
                'user_id' => $this->id,
                'tweet_id' => $tweet->id,
            ]
        )->exists();
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
     * @return BelongsToMany<User>
     */
    public function followers(): BelongsToMany
    {
        return $this->belongsToMany(
            related: User::class,
            table: 'following',
            foreignPivotKey: 'followed_id',
            relatedPivotKey: 'follower_id'
        )->withTimestamps();
    }

    /**
     * @return BelongsToMany<User>
     */
    public function following(): BelongsToMany
    {
        return $this->belongsToMany(
            related: User::class,
            table: 'following',
            foreignPivotKey: 'follower_id',
            relatedPivotKey: 'followed_id'
        )->withTimestamps();
    }
}
