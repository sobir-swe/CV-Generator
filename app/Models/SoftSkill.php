<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SoftSkill extends Model
{
    /** @use HasFactory<\Database\Factories\SoftSkillFactory> */
    use HasFactory;

    protected $fillable = [
        'skill_name',
        'skill_description',
        'skill_level',
    ];
}
