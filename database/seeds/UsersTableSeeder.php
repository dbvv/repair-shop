<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use App\User;

class UsersTableSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    $password = Hash::make('1234567890');
    $admin    = User::create(['email' => 'admin@example.com', 'name' => 'admin', 'password' => $password]);
    $manager  = User::create(['email' => 'manager@example.com', 'name' => 'manager', 'password' => $password]);

    // create roles
    $admin_role   = Role::create(['name' => 'admin']);
    $manager_role = Role::create(['name' => 'manager']);

    $admin->assignRole('admin');
    $manager->assignRole('manager');
  }
}
