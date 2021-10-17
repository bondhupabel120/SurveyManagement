<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LoginHistory extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function userName(){
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
