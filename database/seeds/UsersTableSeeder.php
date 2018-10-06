<?php

use App\Models\User;
use Laravel\Passport\Passport;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'name' => 'administrator',
            'email' => 'sscn@tangerangkab.go.id',
            'password' => Hash::make('rahasiakominfo')
        ]);

        $client = Passport::client()->forceFill([
            'user_id' => $user->id,
            'name' => 'devmaster',
            'secret' => 'aC2PpFiwZh5pGonEp3ezm9JuidZhEkruft1gKYMF', //str_random(40),
            'personal_access_client' => false,
            'password_client' => true,
            'revoked' => false,
            'redirect' => 'http://',
        ]);

        $client->save();
    }
}
