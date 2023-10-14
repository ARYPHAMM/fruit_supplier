<?php

namespace App\Infrastructure\Eloquent\Product;

use App\Infrastructure\Eloquent\BaseModel;
use App\Infrastructure\Eloquent\Category\Category;
use Illuminate\Database\Eloquent\Model;

class Product extends BaseModel
{
  protected $table = "products";
  protected $primaryKey = 'id';
  protected $guarded = [];
  public function category(){
   return  $this->belongsTo(Category::class,'category_id_1','id');
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
