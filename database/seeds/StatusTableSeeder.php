<?php

use App\Status;
use Illuminate\Database\Seeder;

class StatusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $statuses = ['draft', 'published', 'deleted'];

        foreach ($statuses as $status) {
            Status::create([
                'name' => $status
            ]);
        }
    }
}
