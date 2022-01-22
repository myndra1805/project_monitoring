<?php

namespace Database\Seeders;

use App\Models\ProjectLeader;
use Illuminate\Database\Seeder;

class ProjectLeaderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ProjectLeader::factory()->count(10)->create();
    }
}
