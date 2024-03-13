<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Tavern;
use App\Models\Role;
use App\Http\Controllers\TavernController;

class SessionController extends Controller
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
            return response()->json($validator->getMessageBag(), 403);
        } else {
            $remember = isset($data['remember_me']) ? $data['remember_me'] : false;
            if (auth()->attempt(['email' => $data['email'], 'password' => $data['password']], $remember)) {
                session()->regenerate();

                return route('tavern', auth()->user()->taverns[0]->id);
            } else {
                return response()->json(['error' => 'Invalid credentials'], 403);
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
            'role' => ['required', 'string', 'max:2'],
        ]);

        if ($validator->fails()) {
            return response()->json($validator->getMessageBag(), 403);
        } else {
            $tavern = Tavern::firstWhere('code', $data['tavern_code']);
            $role = Role::firstWhere('code', $data['role']);

            if ($role->code != "TK" && !$tavern) {
                return response()->json(['error' => 'Invalid tavern code'], 403);
            }

            $user = User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => Hash::make($data['password'])
            ]);

            $user->roles()->attach($role);

            if ($tavern != null) {
                $user->taverns()->attach($tavern);
            } else {
                $tavern = Tavern::create([
                    'name' => 'New Tavern',
                    'description' => '',
                    'code' => TavernController::makeUniqueCode(),
                    'keeper_id' => $user->id
                ]);

                $user->taverns()->attach($tavern);
            }

            Auth::login($user);

            return route('tavern', $tavern->id);
        }
    }
}
