<?php

namespace Database\Seeders;

use App\Models\Task;
use Illuminate\Database\Seeder;

class TaskSeeder extends Seeder
{
    public function run()
    {
        Task::create([
            'name' => 'Tugas Matematika',
            'subject_id' => 1,
            'day_id' => 1,
            'deadline' => '2024-12-01',
            'file' => 'matematika.pdf',
            'desc' => 'Pekerjaan rumah tentang aljabar',
            'status' => 'pending',
        ]);
    }
}
