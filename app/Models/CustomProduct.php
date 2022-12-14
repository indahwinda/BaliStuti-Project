<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomProduct extends Model
{
    use HasFactory;
    protected $table = 'custom_products';
    protected $guarded = [];
    protected $fillable = [
        'id',
        'name',
        'user_id',
        'description',
        'image',
        'status',
    ];


}
