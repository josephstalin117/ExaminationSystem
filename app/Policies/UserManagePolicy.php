<?php

namespace App\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Config;
use App\User;

class UserManagePolicy {
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct() {
        //
    }

    public function userManage(User $user) {
        return $user->role == intval(Config::get('constants.ROLE_ADMIN'));
    }
}
