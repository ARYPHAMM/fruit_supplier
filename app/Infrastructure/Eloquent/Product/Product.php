<?php

namespace App\Infrastructure\Eloquent\Product;

use App\Infrastructure\Eloquent\BaseModel;
use App\Infrastructure\Eloquent\Category\Category;

class Product extends BaseModel
{
  protected $table = "products";
  protected $primaryKey = 'id';
  protected $guarded = [];
  public function category()
  {
    return  $this->belongsTo(Category::class, 'category_id', 'id');
  }
  public static function defaultUnits()
  {
    return ['kg','pcs','pack'];
  }
}
