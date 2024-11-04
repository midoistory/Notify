<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    use HasFactory;

    protected $fillable = ['name','desc'];

    public function tasks()
    {
        return $this->hasMany(Task::class, 'subjects_id');
    }

    public function notes()
    {
        return $this->hasMany(Note::class, 'subjects_id');
    }
}
