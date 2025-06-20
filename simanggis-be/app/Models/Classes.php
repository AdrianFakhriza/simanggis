<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Classes extends Model
{
    use HasFactory;

    protected $primaryKey = 'class_id';
    protected $table = 'classes';

    protected $fillable = [
        'school_id',
        'class_name',
        'teacher_id',
        'description'
    ];

    public function school()
    {
        return $this->belongsTo(School::class, 'school_id', 'school_id');
    }

    public function students()
    {
        return $this->hasMany(Student::class, 'class_id', 'class_id');
    }

    public function teacher()
    {
        return $this->belongsTo(User::class, 'teacher_id');
    }
}
