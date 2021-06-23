<?php

namespace App\Http\Controllers\Admin;

use App\Dal\Entities\Admin\UserAdmin;
use App\Dal\Entities\User;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
  use AuthenticatesUsers;
  
  /**
   * Where to redirect users after login.
   *
   * @var string
   */
  protected $redirectPath;
  
  public function __construct()
  {
      $this->redirectPath = route('admin.home');
  }
  
  public function showLoginForm()
  {
    return view('admin.auth.login');
  }

    public function showRegisterForm()
    {
        return view('admin.auth.register');
    }
  
  public function authenticate(Request $request)
  {
    $this->validate($request, [
      'email' => 'bail|required',
      'password' => 'bail|required'
    ]);
  
    $credentials = $request->only('email', 'password');

    if (Auth::attempt($credentials)) {
      return redirect()->intended($this->redirectPath);
    } else {
      return redirect()->back()->withErrors('Пользователь не найден');
    }
  }

    public function register(Request $request)
    {
        $this->validate($request, [
            'email' => 'bail|required',
            'password' => 'bail|required'
        ]);

        $entity = new UserAdmin($request->all());
        $entity->password = \Hash::make($request->password);
        $entity->name = $request->email;
        $entity->save();

        $credentials = $request->only('email', 'password');


        if (Auth::attempt($credentials)) {
            return redirect()->intended($this->redirectPath);
        } else {
            return redirect()->back()->withErrors('Пользователь не найден');
        }
    }
  
  public function logout()
  {
    Auth::logout();
    return redirect(route('login'));
  }
}
