<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service_request extends Model
{
    use HasFactory;
    protected $table = 'service_request';
    protected $fillable = [
       '*'
    ];
    public $timestamps = false;
}
