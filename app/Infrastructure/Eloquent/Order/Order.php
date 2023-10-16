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
  protected $appends = ['total'];
  public function orderDetails()
  {
    return $this->hasMany(OrderDetail::class, 'order_id', 'id');
  }
  public function getTotalAttribute()
  {
    $total = 0;
    foreach ($this->orderDetails as $key => $value)
      $total += $value->price * $value->quantity;
    return $total;
  }
}
