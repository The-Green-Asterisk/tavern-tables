<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Tavern;

class Session extends Controller
{
    public function signupForm()
    {
        return view('components.modals.signup');
    }

    public function loginForm()
    {
        return view('components.modals.login');
    }

    public function login(Request $request)
    {
        $data = $request->toArray();

        $validator = Validator::make($data, [
            'email' => ['required', 'email', 'max:255'],
            'password' => ['required', 'min:6'],
        ]);

        if ($validator->fails()) {
            return response()->json($validator->getMessageBag(), 200);
        } else {
            if (auth()->attempt(['email' => $data['email'], 'password' => $data['password']], $data['remember_me'])) {
                session()->regenerate();

                return redirect()->route('tavern', ['tavern', auth()->user()->taverns[0]->id]);
            } else {
                return response()->json(['error' => 'Invalid credentials'], 200);
            }
        }
    }

    public function logout()
    {
        Auth::logout();

        return redirect('/');
    }

    public function forgotPassword(Request $request)
    {
        $data = $request->toArray();

        $validator = Validator::make($data, [
            'email' => ['required', 'email', 'max:255'],
        ]);

        if ($validator->fails()) {
            return response()->json($validator->getMessageBag(), 200);
        } else {
            $status = Password::sendResetLink(
                $request->only('email')
            );

            return $status === Password::RESET_LINK_SENT
                ? response()->json(['success' => 'Password reset link sent'], 200)
                : response()->json(['error' => 'Unable to send password reset link'], 200);
        }
    }

    public function signup(Request $request)
    {
        $data = $request->toArray();
        $tavern = new Tavern();

        $validator = Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'unique:users', 'max:255'],
            'password' => ['required', 'min:6', 'confirmed'],
        ]);

        if ($validator->fails()) {
            return response()->json($validator->getMessageBag(), 200);
        } else {
            $user = User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => Hash::make($data['password'])
            ]);

            if (isset($data['tavern'])) {
                dd('tavern shouldn\'t be set');
                $tavern = Tavern::find($data['tavern']);
                $user->taverns()->attach($tavern);
            } else {
                $tavern = Tavern::create([
                    'name' => 'New Tavern',
                    'description' => '',
                    'keeper_id' => $user->id
                ]);

                $user->taverns()->attach($tavern);
            }

            Auth::login($user);

            return route('tavern', ['id' => $tavern->id]);
        }
    }
}
