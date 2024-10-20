<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SocialNetwork extends Model
{
    /** @use HasFactory<\Database\Factories\SocialNetworkFactory> */
    use HasFactory;

    protected $fillable = ['name', 'link'];

    public function users(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(User::class, 'social_network_user')
            ->withPivot('username');
    }
}
