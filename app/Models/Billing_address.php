<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Billing_address extends Model
{
    use HasFactory;
    protected $table = 'billing_address';
    protected $fillable = [
        '*'
    ];
    public $timestamps = false;
}
