<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Authors extends Model
{
    use HasFactory;

    public function books(){
        return $this->belongsTo(Books::class,'author_id', 'id' );
    }
}
