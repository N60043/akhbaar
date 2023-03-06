<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bookmark extends Model
{
     use HasFactory;
    protected $table="bookmark";
    protected $primaryKey="bookmark_id";
    public $timestamps = false;
    function getNews()
    {
        return $this->hasMany('App\Models\News','news_id','news_id');
    }
    
}
