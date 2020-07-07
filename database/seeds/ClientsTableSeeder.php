<?php

use Illuminate\Database\Seeder;
use App\Client;
class ClientsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $clients =['ahmed','mohamed'];
        foreach($clients as $client){
Client::create([
'name'=>$client,
'phone'=>['01143722697',null],
'address'=>'bolak'
]);

        }
    }
}
