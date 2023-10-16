<?php

namespace App\Infrastructure\Eloquent\Order;

use App\Infrastructure\Eloquent\BaseModel;

class OrderDetail extends BaseModel
{
  protected $table = "order_details";
  protected $primaryKey = 'id';
  protected $guarded = [];
  public function order()
  {
    return  $this->belongsTo(Order::class, 'order_id', 'id');
  }
}
