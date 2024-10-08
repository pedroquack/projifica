<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'modality',
        'expiration',
        'slots',
        'user_id',
    ];

    protected $casts = ['expiration' => 'date'];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function skills(){
        return $this->belongsToMany(Skill::class,'link_skill_projects');
    }

    public function candidates(){
        return $this->hasMany(LinkUserProject::class);
    }

    public function reports(){
        return $this->morphMany(Report::class,'target');
    }

}
