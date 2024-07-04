<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
    public function commentedby(){
        return $this->belongsTo(User::class, "user_id", "id");
    }
}
