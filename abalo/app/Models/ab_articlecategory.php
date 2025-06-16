<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ab_articlecategory extends Model
{
    use hasFactory;

    protected $table = 'ab_articlecategory';
    protected $primaryKey = 'id';
    protected $fillable = ['id', 'ab_name'];
}
