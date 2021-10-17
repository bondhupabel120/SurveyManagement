<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserQuestion extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function userName(){
        return $this->belongsTo(User::class, 'created_by', 'id');
    }
}
