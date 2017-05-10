<?php

use Illuminate\Database\Seeder;
use App\Admin;
class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {   

        for($i=0; $i<100;$i++){
            Admin::create([
                'name'=>'xiaomo'.$i,
                'password'=>bcrypt('123456'),
                'email'=>'413964626'.$i.'@qq.com'
            ]);
        }
    }
}
