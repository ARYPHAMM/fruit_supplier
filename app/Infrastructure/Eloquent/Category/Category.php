<?php

namespace App\Infrastructure\Eloquent\Category;

use App\Infrastructure\Eloquent\BaseModel;
use App\Infrastructure\Eloquent\Product\Product;
use Illuminate\Database\Eloquent\Model;

class Category extends BaseModel
{
  protected $table = "categories";
  protected $primaryKey = 'id';
  protected $guarded = [];
  public function products(){
    return $this->hasMany(Product::class,'category_id_1','id');
  }
  public function getAvatar()
  {
    $medias = $this->getMedia('avatar');
    $avatar = '';
    foreach ($medias as $media) {
      $avatar = $media->getFullUrl();
    }
    return $avatar;
  }
}
