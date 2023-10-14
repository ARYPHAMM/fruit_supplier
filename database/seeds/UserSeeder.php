<?php

use App\Infrastructure\Eloquent\User\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new User();
        $user->name = "staff";
        $user->email = "staff@localhost.com";
        $user->password = Hash::make('123456');
        $user->email_verified_at = (new Carbon())->toDateTimeLocalString();
        $user->save();

    }
}
