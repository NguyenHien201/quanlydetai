<?php

namespace App\Models;

use App\traits\QueryScopes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserCatalogue extends Model
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
        'publish'
    ];
    protected $table = 'user_catalogues';
    
    public function users() {
        return $this->hasMany(User::class, 'user_catalogue_id', 'id');
    }

}
