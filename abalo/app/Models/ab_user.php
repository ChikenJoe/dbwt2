<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ab_user extends Model
{
    //  use hasFactory ??
    use HasFactory;


    protected $table = 'ab_user';
    protected $primaryKey = 'id';
    protected $fillable = ['id', 'ab_name', 'ab_password', 'ab_mail'];

}
