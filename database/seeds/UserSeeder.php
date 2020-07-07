<?php

use Illuminate\Database\Seeder;
use App\user;
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
$user= user::create([
    'first_name'=>'super',
    'last_name'=> 'admin',
    'email'=>'super_admin@app.com',
    'password'=>bcrypt('12345')
]);
$user->attachRole('super_admin');
    }
}
