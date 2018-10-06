<?php

namespace App\Models;

use Laravel\Passport\HasApiTokens;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Notifications\Notifiable;
use App\Http\Resources\Account\UserResource;
// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function scopeChangeInfo($query, $request)
    {
        if ($query->update([
            'name' => $request->name,
            'email' => $request->email,
            'avatar' => $request->avatar ?: null
        ])) {
            return new UserResource(
                $request->user()
            );
        }
    }

    public function scopeChangePassword($query, $request)
    {
        if (Hash::check($request->password_current, Auth::user()->password)) {
            return $query->update([
                'password' => Hash::make($request->password)
            ]);
        } else {
            return false;
        }
    }
}
