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
    return ['kg', 'pcs', 'pack'];
  }
  public function scopeSearch($query)
  {
    $search = @request()->query('search');
    if (!is_null($search))
      $query->where("name", 'like', "%{$search}%");
    $filter_data = request()->only('category_id');
    foreach ($filter_data as $key => $value)
      if (!is_null($value))
        $query->where($key, $value);
  }
}
