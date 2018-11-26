<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class ConfirmEmailController extends Controller
{
    public function index()
    {
        $token = request('token');
        $user = User::where('confirm_token', $token)->first();

        if($user) {
            $user->confirm();
            session()->flash('success', 'Your email has been confirmed.');
            return redirect('/');
        } else {
            session()->flash('error', 'Confirmation token not recognised.');
            return redirect('/');
        }
    }

}
