<?php

use Illuminate\Database\Seeder;
use CodeProject\Entities\ProjectNote;

class ProjectNoteTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ProjectNote::truncate();
		factory(ProjectNote::class, 50)->create();
    }
}
