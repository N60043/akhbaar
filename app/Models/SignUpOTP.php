<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SignUpOTP extends Model
{
    use HasFactory;
    protected $table            = 'signup_otp';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $protectFields    = true;
    public $timestamps       =false;
    protected $fillable         = ['number','otp','date','attempt'];

}
