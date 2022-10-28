<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use RecentlyViewed\Models\Contracts\Viewable;
use RecentlyViewed\Models\Traits\CanBeViewed;
use Haruncpi\LaravelIdGenerator\IdGenerator;

class Product extends Model implements Viewable
{
    use HasFactory;
    use CanBeViewed;
    protected $table = 'products';
    protected $guarded = [];
    public $incrementing = false;
    protected $fillable = [
        'id',
        'cate_id',
        'name',
        'small_description',
        'description',
        'original_price',
        'selling_price',
        'image',
        'gallery',
        'qty',
        'weight',
        'tax',
        'meta_title',
        'meta_keywords',
        'meta_description',
    ];
    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $model->id = IdGenerator::generate(['table' => 'products', 'length' => 6, 'prefix' =>date('ym')]);
        });
    }
    public function images(){
        return $this->hasMany(Gallery::class);
    }
    
}
