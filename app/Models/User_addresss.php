<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User_addresss extends Model
{
    use HasFactory;
    protected $table = 'user_address';
    protected $fillable = [
        '*'
    ];
    public $timestamps = false;
}
