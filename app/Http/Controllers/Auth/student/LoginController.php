<?php

namespace App\Http\Controllers\Auth\student;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
Use App\model\Student;

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
    // protected $redirectTo = '/studentindex';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function showLoginForm()
    {
        return view('auth.student.login');
    }

    public function login(Request $request)
    {

      $this->validate($request, [
        'email' => 'required',
        'password' => 'required',
      ]);

    //   if (Auth::guard('student')->attempt(['email' => $request->email, 'password' => $request->password], $request->remember)) {
    //     // Log Him Now
    //     return redirect()->intended(route('student.index'));
    //   }else {
    //     session()->flash('sticky_error', 'Invalid Login');
    //     return "error";
    //   }
        if (Auth::guard('student')->attempt($this->credentials($request))) {
            return redirect()->intended(route('student.index'));
        }else{
            session()->flash('sticky_error', 'Invalid Login');
            return redirect()->back()->withInput($request->only('email'));
        }

    }

    protected function credentials(Request $request)
    {
        if(is_numeric($request->get('email'))){
            return ['mobile'=>$request->get('email'),'password'=>$request->get('password')];
        }
        return $request->only($this->username(), 'password');
    }


    public function logout(Request $request)
    {
        Auth::guard('student')->logout();

        // $request->session()->invalidate();

        return $this->loggedOut($request) ?: redirect('student/login');
    }

}
