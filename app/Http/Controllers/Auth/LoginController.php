<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Model\AdminUser;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
//        $this->middleware('guest')->except('logout');
    }

    public function login(Request $request)
    {
        if ($request->getMethod() == 'GET') {
            return view('admin.auth.login');
        }
        $request->validate([
           'username' => 'required',
           'password' => 'required'
        ]);

        $admin = AdminUser::where('username',$request->get('username'))
            ->first();
        if (!$admin) {
            return view('admin.auth.login');
        }
        if(Hash::check($request->get('password'), $admin->password)){

            session(['admin' => json_encode($admin->toArray())]);
            return redirect('/admin/dev/users/show');
        }
      /*  if (Hash::check($request->get('password'), $admin->password) {

        }*/
    }
}
