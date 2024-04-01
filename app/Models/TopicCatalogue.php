<?php

namespace App\Models;

use App\traits\QueryScopes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TopicCatalogue extends Model
{
    use HasFactory, QueryScopes, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

    protected $fillable = [
        'name',
        'description',
    ];
    protected $table = 'topic_catalogues';
    
    public function topics() {
        return $this->hasMany(Topic::class, 'topic_catalogue_id', 'id');
    }

}
