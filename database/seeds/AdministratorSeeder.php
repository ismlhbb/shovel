<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdministratorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $administrator = new \App\User;
        $administrator->username = "administrator";
        $administrator->name = "Site Administrator";
        $administrator->email = "administrator@shovel.test";
        $administrator->roles = json_encode(["ADMIN"]);
        $administrator->password = Hash::make("shovel");
        $administrator->avatar = "saat-ini-tidak-ada-file.png";
        $administrator->address = "Parung Panjang, Kab.Bogor, Jawa Barat";
        $administrator->phone = "085921211087";
        $administrator->save();
        $this->command->info("User Admin has successfully inserted");
    }
}
