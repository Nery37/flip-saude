<?php

namespace Database\Seeders;

use App\Entities\Status;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class StatusSeeder extends Seeder
{
    public function run()
    {
        $taskStatus = [
            [
                'id' => 1,
                'name' => 'concluded',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'id' => 2,
                'name' => 'pending',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ]
        ];

        foreach ($taskStatus as $status) {
            Status::query()->insertOrIgnore($status);
        }
    }
}
