<?php

use App\Goal;
use Illuminate\Database\Seeder;

class GoalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Goal::create([
            'name' => 'Push Up 10 times a day',
            'achived_at' => null,
            'is_not_lazy' => false,
            'started_at' => '2020-06-17',
            'total_day' => 30,
            'current_day' => 5,
            'user_id' => 1,
        ]);
        Goal::create([
            'name' => 'Learn How to Code',
            'achived_at' => null,
            'is_not_lazy' => false,
            'started_at' => '2020-06-17',
            'total_day' => 15,
            'current_day' => 1,
            'user_id' => 1,
        ]);
        Goal::create([
            'name' => 'Learn Cook like Gordon Ramsay',
            'achived_at' => null,
            'is_not_lazy' => false,
            'started_at' => '2020-06-17',
            'total_day' => 5,
            'current_day' => 4,
            'user_id' => 1,
        ]);
    }
}
