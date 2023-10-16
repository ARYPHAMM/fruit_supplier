<?php

namespace App\Infrastructure\Eloquent\Order;

use App\Infrastructure\Eloquent\BaseModel;
use App\Infrastructure\Traits\UuidTrait;

class Order extends BaseModel
{
  use UuidTrait;
  protected $table = "orders";
  protected $primaryKey = 'id';
  protected $guarded = [];
  public function orderDetails()
  {
    return $this->hasMany(OrderDetail::class, 'order_id', 'id');
  }
  public function orderDetailsPivot()
  {
    return $this->belongsToMany(Weight::class,"commodity_weights", "commodity_id", "weight_id");
  }
}
