<?php

namespace App\Infrastructure\Eloquent\Order;

use App\Infrastructure\Eloquent\BaseModel;

class OrderDetail extends BaseModel
{
  protected $table = "order_details";
  protected $primaryKey = 'id';
  protected $guarded = [];
  protected $appends = ['total'];
  public function order()
  {
    return  $this->belongsTo(Order::class, 'order_id', 'id');
  }
  public function getTotalAttribute()
  {
    return $this->quantity * $this->price;
  }
}
