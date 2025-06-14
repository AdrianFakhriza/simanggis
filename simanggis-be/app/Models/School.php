<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class School extends Model
{
    use HasFactory;

    protected $primaryKey = 'school_id';

    protected $fillable = [
        'school_name',
        'user_id',
        'address',
        'contact_number',
    ];

    public function students()
    {
        return $this->hasMany(Student::class, 'school_id', 'school_id');
    }

    public function MealDistributions()
    {
        return $this->hasMany(MealDistribution::class, 'school_id', 'school_id');
    }

    public function users()
    {
        return $this->hasMany(User::class, 'school_id');
    }
}
