<?php

namespace App\Models;

use App\traits\QueryScopes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SchoolYear extends Model
{
    use HasFactory, QueryScopes;

    protected $fillable = [
        'name',
        'start_date',
        'end_date',
    ];
    protected $table = 'school_years';

    public function students() {
        return $this->hasMany(Student::class, 'school_year_id', 'id');
    }
    
    public function topics() {
        return $this->hasMany(Topic::class, 'school_year_id', 'id');
    }
}
