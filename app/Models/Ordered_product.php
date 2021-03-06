<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ordered_product extends Model
{
    use HasFactory;
    protected $table = 'ordered_product';
    protected $fillable = [
        '*'
    ];
    public $timestamps = false;
}
