<?php

namespace App\Models;

use App\traits\QueryScopes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Position extends Model
{
    use HasFactory, QueryScopes;

    protected $fillable = [
        'name',
        'description'
    ];

    protected $table = 'positions';

    public function lecturers() {
        return $this->hasMany(Lecturer::class, 'position_id', 'id');
    }
}
