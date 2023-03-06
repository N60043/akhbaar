<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class News extends Model
{
    use HasFactory;
    protected $table="news";
    protected $primaryKey="news_id";
    function getNewsCategory()
    {
        return $this->hasMany('App\Models\Newscategory','news_category_id','news_category_id')->orderBy('sort_by');
    }
     function getNewspaper()
    {
        return $this->hasMany('App\Models\Newspaper','id','newspaper_id');
    }
    function getBookmark()
    {
      return $this->belongsTo('App\Models\Bookmark','news_id','news_id');
    }

}
