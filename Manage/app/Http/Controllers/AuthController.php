<?php
/**
 * Created by IntelliJ IDEA.
 * User: Wang
 * Date: 2016/10/14
 * Time: 13:15
 */

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function authenticate()
    {
        if (Auth::attempt(['loginid' => $loginid, 'password' => $password])) {
            // Authentication passed...
            return redirect()->intended('home');
        }
    }
}