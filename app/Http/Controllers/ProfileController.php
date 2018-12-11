<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index(User $user)
    {
        return view('profile')
            ->withUser($user)
            ->with('seriesBeingWatched', $user->seriesBeingWatchedByUser() );
    }

    public function updateCard()
    {
        $this->validate(request(), [
            'stripeToken' => 'required'
        ]);

        $token = request('stripeToken');
        $user = auth()->user();
        $user->updateCard($token);
        return response()->json(['ok']);
    }

}
