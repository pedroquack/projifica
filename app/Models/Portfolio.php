<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Portfolio extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'image',
        'url',
        'user_id'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function skills(){
        return $this->belongsToMany(Skill::class,'link_skill_portfolios');
    }

    public function link_skills(){
        return $this->belongsToMany(LinkSkillPortfolio::class);
    }

}
