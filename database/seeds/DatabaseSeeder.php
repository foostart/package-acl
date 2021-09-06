<?php namespace Foostart\Acl\Database;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model as Eloquent;
use Illuminate\Support\Facades\App;
use Foostart\Acl\Database\PermissionSeeder;

/**
 * Class DbSeeder
 *
 * @author Foostart foostart.com@gmail.com
 */
class DatabaseSeeder extends Seeder
{
    public function run()
    {
        Eloquent::unguard();

        $this->call('Foostart\Acl\Database\PermissionSeeder');
        $this->call('Foostart\Acl\Database\GroupsSeeder');
        $this->call('Foostart\Acl\Database\UserSeeder');

        Eloquent::reguard();
    }
}
