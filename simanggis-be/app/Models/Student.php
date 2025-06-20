<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Student extends Model
{
    use HasFactory;

    protected $primaryKey = 'student_id';

    protected $fillable = [
        'school_id',
        'name',
        'class_id'
    ];
    
    public function school()
    {
        return $this->belongsTo(School::class, 'school_id', 'school_id');
    }

    public function MealDistributions()
    {
        return $this->hasMany(MealDistribution::class, 'student_id', 'student_id');
    }

    public function feedbacks()
    {
        return $this->hasMany(Feedback::class, 'student_id', 'student_id');
    }

    public function classes()
    {
        return $this->belongsTo(Classes::class, 'class_id', 'class_id');
    }
}
