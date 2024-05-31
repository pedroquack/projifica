<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Education extends Model
{
    use HasFactory;

    protected $fillable = [
        'school',
        'course',
        'start_date',
        'end_date',
        'user_id',
    ];

    public function user(){
        return $this->belongsTo('App\Models\User');
    }

}
