<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Newscategory extends Model
{
    use HasFactory;
    protected $table            = 'news_category';
    protected $primaryKey       = 'categoryid';
    protected $useAutoIncrement = true;
    protected $protectFields    = true;
    public $timestamps = false;
    protected $allowedFields    = ['name','urdu_name','sort_by'];
    
    // public function getNews()
    // {
    //     return $this->belongsTo(News::class);
    // }

}
