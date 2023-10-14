<?php

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

function checkValidate($rules = [], $messages = [])
{
  $validator = Validator::make(request()->all(), $rules, $messages);
  if ($validator->fails())
    return $validator;
  return false;
}
function fillData(Model $item, $data)
{
  DB::transaction(function () use ($item, $data) {
    $item->fill($data);
  });
}
function checkUrlActive($arr = [])
{
  return  in_array(url()->current(), $arr);
}
function checkRouteActive($arr  = [])
{
  return in_array(request()->route()->getName(), $arr);
}
