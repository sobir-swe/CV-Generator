<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'nt_id',
        'image',
        'phone',
        'profession',
        'biography',
    ];

    /**
     * Projects relation.
     */
    public function projects(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Project::class);
    }

    /**
     * Educations relation.
     */
    public function educations(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Education::class);
    }

    /**
     * Experiences relation.
     */
    public function experiences(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Experience::class);
    }

    /**
     * Social Networks relation (Many-to-Many).
     */
    public function social_networks(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(SocialNetwork::class, 'social_network_user')
            ->withPivot('username');
    }

    /**
     * Skill user relation (Many-to-Many).
     */
    public function skill_user(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Skill::class, 'skill_user');
    }

    /**
     * Language user relation (Many-to-Many).
     */
    public function language_user(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Language::class, 'language_user')
            ->withPivot('level');
    }
}
