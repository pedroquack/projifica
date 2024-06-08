<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LinkSkillProject extends Model
{
    use HasFactory;

    protected $fillable = [
        'project_id',
        'skill_id'
    ];

    public function project(){
        return $this->belongsTo(Project::class);
    }

    public function skill(){
        return $this->belongsTo(Skill::class);
    }
}
