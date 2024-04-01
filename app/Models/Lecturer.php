<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lecturer extends Model
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
        'department_id',
        'position_id'
    ];

    protected $table = "lecturers";

    public function users() {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function departments() {
        return $this->belongsTo(Department::class, 'department_id', 'id');
    }

    public function positions() {
        return $this->belongsTo(Position::class, 'position_id', 'id');
    }

    public function students()
    {
        return $this->belongsToMany(Student::class, 'students_group', 'lecturer_id', 'student_id');
    }

    public function topics()
    {
        return $this->hasMany(Topic::class, 'lecturer_id');
    }

}
