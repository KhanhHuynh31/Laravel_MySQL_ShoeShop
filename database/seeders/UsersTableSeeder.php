<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Admin;
use App\Models\Roles;
Use DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Admin::truncate();
        DB::table('admin_roles')->truncate();

        $adminRoles = Roles::where('name', 'admin')->first();
        $authorRoles = Roles::where('name', 'author')->first();
        $userRoles = Roles::where('name', 'user')->first();

        $admin = Admin::create([
            'admin_name' => 'hieuadmin',
            'admin_email' => 'hieuadmin@yahoo.com',
            'admin_phone' => '123456789',
            'admin_password' => md5('123456')
        ]);

        $author = Admin::create([
            'admin_name' => 'hieuauthor',
            'admin_email' => 'hieuauthor@yahoo.com',
            'admin_phone' => '123456789',
            'admin_password' => md5('123456')
        ]);

        $user = Admin::create([
            'admin_name' => 'hieuuser',
            'admin_email' => 'hieuuser@yahoo.com',
            'admin_phone' => '123456789',
            'admin_password' => md5('123456')
        ]);

        $admin->roles()->attach($adminRoles);
        $author->roles()->attach($authorRoles);
        $user->roles()->attach($userRoles);

    }
}
