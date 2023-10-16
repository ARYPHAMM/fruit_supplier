<?php
namespace App\Infrastructure\Eloquent;
use Illuminate\Database\Eloquent\Model;
class BaseModel extends Model
{
    public function getCreatedAtAttribute($date)
    {
        return $date;
    }
    public function getUpdatedAtAttribute($date)
    {
        return $date;
    }
}
