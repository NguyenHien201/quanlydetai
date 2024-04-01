<?php

namespace App\Models;

use App\traits\QueryScopes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory, QueryScopes;

    protected $fillable = [
        'code',
        'name',
        'start_time'
    ];

    protected $table = 'departments';

    public function majors() {
        return $this->hasMany(Major::class, 'department_id', 'id');
    }

    public function lecturers() {
        return $this->hasMany(Lecturer::class, 'department_id', 'id');
    }
}
