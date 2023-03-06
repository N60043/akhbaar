<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActivityLog extends Model
{
    use HasFactory;
      protected $table='activity_logs_02';
    protected $primaryKey= 'id';
     protected $fillable = [
        'type','url','method','ip','agent','phone'
    ];

}
