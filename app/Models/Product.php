<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = ['category_id','sub_category_id','brand_id','unit_id','name','code','model','stock_amount','regular_price','selling_price',
        'short_description','long_description','image','other_image','status'];

    public function category ()
    {
        return $this->belongsTo(Category::class);
    }
    public function SubCategory()
    {
        return $this->belongsTo(SubCategory::class);
    }
    public function brand()
    {
        return $this->belongsTo(SubCategory::class);
    }
    public function unit()
    {
        return $this->belongsTo(SubCategory::class);
    }
}
