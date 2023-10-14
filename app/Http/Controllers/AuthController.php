<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthRequest\LoginRequest;
use App\Infrastructure\Eloquent\User\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;

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
      return redirect()->route('login');
    return view("auth.login");
  }
  public function logout()
  {
    return redirect()->route('login')->with('success', 'Logout successfully')->with(Auth::logout());
  }
  public function postLogin(LoginRequest $request)
  {
    $data = $request->only('email', 'password');
    $user = $this->user->where('email', $data['email'])->first();
    if (!$user)
      return back()->with('error', 'Email not found');
    if ($user && !$user->hasVerifiedEmail())
      return back()->with('error', 'Email not verfied
      ');
    if (!Hash::check($data['password'], $user->password))
      return redirect()->back()->with('error', 'Incorrect password');
    $credential = $request->only('email', 'password');
    if (Auth::attempt($credential)) {
      return redirect()->route('home')->with('success', 'Logged in successfully');
    }
    return redirect()->back()->with('error', 'Incorrect account or password');
  }
}
