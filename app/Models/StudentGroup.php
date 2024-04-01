<?php

namespace App\Models;

use App\traits\QueryScopes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentGroup extends Model
{
    use HasFactory, QueryScopes;

    protected $fillable = [
        'lecturer_id',
        'student_id'
    ];

    protected $primaryKey = 'lecturer_id';

    protected $table = 'students_group';

    public function lecturers()
    {
        return $this->belongsTo(Lecturer::class, 'lecturer_id');
    }

    public function students()
    {
        return $this->belongsTo(Student::class, 'student_id');
    }
}
