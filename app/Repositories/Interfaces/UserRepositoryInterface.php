<?php

namespace App\Repositories\Interfaces;

use App\User;

interface UserRepositoryInterface
{
    public function all();

    public function findByTwitchId(string $twitchId);

    public function create($data): User;

    public function findByRoleName(string $roleName);

    public function findByPermission(string $permission);
}
