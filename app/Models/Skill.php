<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Skill extends Model
{
    use HasFactory;

    protected $fillable = [
        'name'
    ];

    public function portfolios(){
        return $this->belongsToMany(Portfolio::class,'link_skill_portfolio');
    }
}
