<?php

namespace App\Console\Commands;

use App\User;
use Exception;
use Illuminate\Console\Command;
use Spatie\Permission\Models\Role;

class SetSuperAdminCommand extends Command
{
    private string $roleName;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'superadmin:add {--display_name= : The user\'s display name} {--twitch_id= : The user\'s twitch id}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = "Adds the 'Super Admin' role to a defined user";

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $this->roleName = config('permission.consts.super_admin_name');
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        if (config('app.debug') !== true) {
            $this->error('App is not in debug mode, unable to execute command');
            return;
        }
        $options = $this->options();

        if (is_null($options['display_name']) && is_null($options['twitch_id'])) {
            $this->error('Please provide either a display_name or twitch_id value');
            return;
        } else {
            if (!is_null($options['display_name'])) {
                $attribute = [
                    'column' => 'display_name',
                    'value' => $options['display_name']
                ];
            } else {
                $attribute = [
                    'column' => 'twitch_id',
                    'value' => $options['twitch_id']
                ];
            }
        }

        $role = Role::where('name', $this->roleName)->first();

        if (!$role) {
            $this->error("Role '{$this->roleName}' not found, are you sure you ran the database seeder?");
            return;
        }

        $user = User::where($attribute['column'], $attribute['value'])->first();

        if (!$user) {
            $this->error("User with {$attribute['column']} '{$attribute['value']}' not found");
            return;
        }

        try {
            $user->assignRole($role);
            $this->info("Successfully added user with {$attribute['column']} '{$attribute['value']}' as Administrator");
        } catch (Exception $e) {
            $this->error("Error when adding {$this->roleName}: {$e->getMessage()}");
        }

        return;
    }
}
