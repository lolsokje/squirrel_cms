<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use Notifiable;
    use HasRoles;

    protected $guarded = [];

    protected $keyType = 'string';

    protected $primaryKey = 'twitch_id';

    public $incrementing = false;
}
