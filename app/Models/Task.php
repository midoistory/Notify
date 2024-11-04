<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = ['name','days_id', 'subjects_id','deadline','file','desc','status'];

    public function day()
    {
        return $this->belongsTo(Day::class, 'days_id');
    }

    public function subject()
    {
        return $this->belongsTo(subject::class, 'subjects_id');
    }
}
