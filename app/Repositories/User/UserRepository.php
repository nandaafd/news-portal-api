<?php

namespace App\Repositories\User;

use LaravelEasyRepository\Repository;

interface UserRepository{

    public function storeUser($data);
}
