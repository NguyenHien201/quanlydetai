<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Topic extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'name',
        'start_date',
        'complate_date',
        'topic_start_date',
        'topic_end_date',
        'report_file',
        'comment',
        'lecturer_score',
        'total_score',
        'result',
        'topic_catalogue_id',
        'major_id',
        'school_year_id',
        'lecturer_id'
    ];

    protected $table = 'topics';

    public function topic_catalogues() {
        return $this->belongsTo(TopicCatalogue::class, 'topic_catalogue_id', 'id');
    }

    public function majors() {
        return $this->belongsTo(Major::class, 'major_id', 'id');
    }

    public function school_years() {
        return $this->belongsTo(SchoolYear::class, 'school_year_id', 'id');
    }

    public function lecturers() {
        return $this->belongsTo(Lecturer::class, 'lecturer_id', 'id');
    }
}
