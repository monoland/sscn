<?php

namespace App\Http\Controllers\Account;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\Account\UserResource;

class UserController extends Controller
{
    public function show(Request $request)
    {
        return new UserResource(
            $request->user()
        );
    }

    public function info(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required'
        ]);

        if ($request->user()->changeInfo($request)) {
            return new UserResource(
                User::find($request->user()->id)
            );
        } else {
            return response()->json([
                'error' => true
            ]);
        }
    }

    public function password(Request $request)
    {
        $this->validate($request, [
            'password_current' => 'required',
            'password' => 'required|confirmed|different:password_current',
            'password_confirmation' => 'required'
        ]);

        return $request->user()->changePassword($request);
    }
}
