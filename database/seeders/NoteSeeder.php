<?php

namespace Database\Seeders;

use App\Models\Note;
use Illuminate\Database\Seeder;

class NoteSeeder extends Seeder
{
    public function run()
    {
        Note::create([
            'name' => 'Note BSD',
            'date' => '2024-12-01',
            'subject_id' => 1,
            'file' => 'matematika.pdf',
            'desc' => 'Pekerjaan rumah tentang aljabar',
        ]);
    }
}
