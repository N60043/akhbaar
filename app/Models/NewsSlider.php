<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NewsSlider extends Model
{
    use HasFactory;
    protected $table            = 'news_slider';
    protected $primaryKey       = 'slider_id';
    protected $useAutoIncrement = true;
    protected $protectFields    = true;
    protected $fillable   = ['newspaper_id','title','description','image','is_active','is_urdu','slider_order'];
    function getNewspaper()
    {
        return $this->hasMany('App\Models\Newspaper','id','newspaper_id');
    }
}
        