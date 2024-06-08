<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LinkUserProject extends Model
{
    use HasFactory;

    use HasFactory;

    protected $fillable = [
        'project_id',
        'user_id',
        'proposal',
        'approved',
    ];

    public function project(){
        return $this->belongsTo(Project::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}
