<?php

namespace App\traits;


trait QueryScopes
{

    public function __construct(){}

    public function scopeKeyword($query, $keyword) {
        if(!empty($keyword)) {
            $query->where('name', 'LIKE', '%'.$keyword.'%');
        }
        return $query;
    }

    public function scopePublish($query, $publish) {
        if(!empty($publish)) {
            $query->where('publish', '=', $publish);
        }
        return $query;
    }

    public function scopeRelationCount($query, $relations) {
        if(isset($relations) && !empty($relations)) {
            foreach($relations as $relation) {
                $query->withCount($relation);
            }
        }
        return $query;
    }
    
    public function scopeCustomJoin($query, $join) {
        if(!empty($join)) {
            foreach($join as $key => $val) {
                $query->join($val[0], $val[1], $val[2], $val[3]);
            }
        }
        return $query;
    }
}
