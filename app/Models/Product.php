<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use RecentlyViewed\Models\Contracts\Viewable;
use RecentlyViewed\Models\Traits\CanBeViewed;

class Product extends Model implements Viewable
{
    use HasFactory;
    use CanBeViewed;
    protected $table = 'products';
    protected $guarded = [];

    public function images(){
        return $this->hasMany(Gallery::class);
    }
    
}
