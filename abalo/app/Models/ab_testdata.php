<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ab_testdata extends Model
{

    //  use hasFactory ??
    use HasFactory;


    protected $table = 'ab_testdata';
    protected $primaryKey = 'id';
    protected $fillable = ['id', 'ab_testname'];

}
