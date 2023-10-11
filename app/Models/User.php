<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Model
{
    use HasFactory,SoftDeletes;
    public $incrementing = false;
    protected $hidden = ['password'];
    protected $table = 'user';
    protected $fillable = [
        'id',
        'first_name',
        'last_name',
        'username',
        'email',
        'password'
    ];
}
