<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    use HasFactory;
    
    protected $fillable = ['name','date', 'subjects_id','file','desc'];

    public function subject()
    {
        return $this->belongsTo(Subject::class, 'subjects_id');
    }
}
