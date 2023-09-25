<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    public function showEnterNameForm()
    {
        return view('enterName');
    }

    public function saveName(Request $request)
    {
        // Validation can be added here if needed
        $name = $request->input('name');

        // Create a new user and save it to the database
        $user = new User();
        $user->name = $name;
        // You can set other user attributes here if needed
        $user->save();


        Session::put('user_id', $user->id); // Store user ID in the session

        return redirect()->route('questions');
    }
}
