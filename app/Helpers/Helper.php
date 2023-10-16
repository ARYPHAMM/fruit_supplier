<?php

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

if (!function_exists('apiError')) {
  function apiError($msg, $errors = null, $code = 422)
  {
    return apiRes(false, $msg, '', $errors, $code);
  }
}
if (!function_exists('apiRes')) {
  function apiRes($status, $message, $data, $error, $code)
  {
    $apiResp = [];
    $apiResp['status'] = $code  ? $code : 200;
    $apiResp['data'] = $data;
    $apiResp['msg'] = $message;
    $apiResp['errors'] = $error;
    return response($apiResp, $code ? $code : 200);
  }
}
if (!function_exists('apiOk')) {
  function apiOk($data, $list = false)
  {
    if (!$list) {
      return apiRes(true, '', $data, null, null);
    } else {
      $data = $data->toArray();
      $data['status'] = 'success';
      $data['msg'] = "";
      $data['errors'] = null;
      //return response($apiResp, $code ? $code : ($status ? 200 : 500));
      // Mobile library friendly with 200 response only: https://github.com/Alamofire/Alamofire
      return response($data, 200);
    }
  }
}
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
