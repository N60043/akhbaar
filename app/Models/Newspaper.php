<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Newspaper extends Model
{
    use HasFactory;
    protected $table            = 'newspaper';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    public $timestamps = false;
    protected $allowedFields    = ['name','icon','is_active','is_urdu'];
        // function getNews()
        // {
        //     return $this->hasMany('App\Models\News','newspaper_id','id');
        // }
}
