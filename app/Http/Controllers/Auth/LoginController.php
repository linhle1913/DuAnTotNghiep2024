<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use PHPUnit\Metadata\Uses;

class LoginController extends Controller
{
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
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }

    /**
     * Handle user authentication and redirection based on role.
     */
    protected function authenticated(Request $request)
    {
        /**
         * @var User $user
         */
        $user = Auth::user();

        if ($user->isAdmin()) {

            return redirect('/admin');
        }
        // Nếu không phải admin, chuyển hướng đến trang khác (ví dụ: trang chủ)
        return redirect()->route('home');
    }
}
