<?php

namespace App;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public $fillable = ['name', 'description', 'price', 'image_path', 'image_name'];

    public function users()
    {
        $this->belongsToMany(User::class);
    }
}
