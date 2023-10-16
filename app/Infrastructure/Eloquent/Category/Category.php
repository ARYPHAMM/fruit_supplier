<?php

namespace App\Infrastructure\Eloquent\Category;

use App\Infrastructure\Eloquent\BaseModel;
use App\Infrastructure\Eloquent\Product\Product;

class Category extends BaseModel
{
  protected $table = "categories";
  protected $primaryKey = 'id';
  protected $guarded = [];
  public function products()
  {
    return $this->hasMany(Product::class, 'category_id', 'id');
  }
}
