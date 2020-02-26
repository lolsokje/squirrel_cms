<?php

namespace App\Repositories\Interfaces;

use App\User;

interface UserRepositoryInterface
{
    public function all();

    public function findByTwitchId(string $twitchId);

    public function findOrUpsert($data): User;
}
