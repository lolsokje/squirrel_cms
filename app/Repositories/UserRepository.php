<?php

namespace App\Repositories;


use App\Repositories\Interfaces\UserRepositoryInterface;
use App\User;
use Illuminate\Database\Eloquent\Collection;

class UserRepository implements UserRepositoryInterface
{
    /**
     * @return User[]|Collection
     */
    public function all()
    {
        return User::all();
    }

    /**
     * @param string $twitchId
     * @return User|null
     */
    public function findByTwitchId(string $twitchId): ?User
    {
        return User::where('twitch_id', $twitchId)->first();
    }

    public function create($data): User
    {
        return User::create([
            'twitch_id' => $data->id,
            'login_name' => $data->login,
            'display_name' => $data->display_name,
            'email' => $data->email,
            'profile_image' => $data->profile_image_url
        ]);
    }

    /**
     * @param string $roleName
     * @return array|User
     */
    public function findByRoleName(string $roleName)
    {
        return User::whereHas('roles', fn($q) => $q->where('name', $roleName))->get();
    }

    public function findByPermission(string $permission)
    {
        $ret = [];
        foreach (User::all() as $user) {
            if ($user->can('edit articles')) {
                $ret[] = $user;
            }
        }

        return $ret;
    }
}
