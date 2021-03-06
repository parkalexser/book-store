<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Books extends Model
{
    use HasFactory;

    public function authors(){
        return $this->hasOne(Authors::class,'id', 'author_id');
    }

    public function orders()
    {
        return $this->belongsToMany(Orders::class, 'book_orders', 'book_id', 'order_id');
    }


}
