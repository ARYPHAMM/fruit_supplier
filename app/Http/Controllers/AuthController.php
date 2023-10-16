<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthRequest\LoginRequest;
use App\Infrastructure\Eloquent\User\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class AuthController extends Controller
{
  protected $user;
  public function __construct(User $user)
  {
    $this->user = $user;
  }
  public function login()
  {
    if (Auth::check())
      return redirect()->route('home');
    return view("auth.login");
  }
  public function logout()
  {
    return redirect()->route('login')->with('success', 'Logout successfully')->with(Auth::logout());
  }
  public function postLogin(LoginRequest $request)
  {
    $credential = $request->only('email', 'password');
    if (Auth::attempt($credential))
      return redirect()->route('home')->with('success', 'Logged in successfully');
    return redirect()->back()->with('error', 'Incorrect account or password');
  }
  public function show(Request $request)
  {
    return $request->user();
  }
  public function home(){
    return view('home');
  }
}
