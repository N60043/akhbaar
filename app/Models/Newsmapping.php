<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Newsmapping extends Model
{
    use HasFactory;
    protected $table            = 'category_maping';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $protectFields    = true;
    public $timestamps = false;
    protected $fillable    = ['newspaper_id','newspaper_cat_id','newspaper_cat_name ','news_category_id','category_url'];
}
