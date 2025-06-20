<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MealDistribution extends Model
{
    use HasFactory;

    protected $primaryKey = 'distribution_id';
    protected $table = 'meal_distributions';

    protected $fillable = [
        'school_id',
        'student_id',
        'teacher_id',
        'class_id',
        'meal_date',
        'status',
    ];

    public function school()
    {
        return $this->belongsTo(School::class, 'school_id', 'school_id');
    }

    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id', 'student_id');
    }

    public function teacher()
    {
        return $this->belongsTo(User::class, 'teacher_id', 'id');
    }

    public function class()
    {
        return $this->belongsTo(Classes::class, 'class_id');
    }
}
