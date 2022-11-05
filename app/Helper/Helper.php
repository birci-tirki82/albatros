<?php

namespace App\Helper;

use App\Models\User;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class Helper
{
    public static function setRoles ()
    {
        $admin_role = Role::whereName('admin')->first();
        $adminUser = User::whereEmail('admin@admin.com')->first();
        $user_role = Role::whereName('user')->first();
        $webUser = User::whereEmail('omer@omer.com')->first();

        $adminUser->assignRole($admin_role);
        $webUser->assignRole($user_role);
    }
}
