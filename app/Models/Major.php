<?php

namespace App\Models;

use App\traits\QueryScopes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Major extends Model
{
    use HasFactory, QueryScopes;

    protected $fillable = [
        'code',
        'name',
        'department_id',
    ];

    protected $table = 'majors';

    public function departments() {
        return $this->belongsTo(Department::class, 'department_id', 'id');
    }

    public function students() {
        return $this->hasMany(Student::class, 'major_id', 'id');
    }

    public function topics() {
        return $this->hasMany(Topic::class, 'major_id', 'id');
    }
}
