<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'name',
        'email',
        'phone',
        'birthday',
        'address',
        'user_id',
        'major_id',
        'school_year_id'
    ];

    protected $table = "students";

    public function users() {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function majors() {
        return $this->belongsTo(Major::class, 'major_id', 'id');
    }

    public function school_years() {
        return $this->belongsTo(SchoolYear::class, 'school_year_id', 'id');
    }

    public function lecturers()
    {
        return $this->belongsToMany(Lecturer::class, 'students_group', 'lecturer_id', 'student_id');
    }
}
